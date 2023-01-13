<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Utils\Validations;
use App\Utils\HelperFunctions;
use App\Models\{User, Trailer, Order, Coupon, OrderReturnTrailerImage, OrderPickupTrailerImage};
use App\Mail\TrailerRefunMail;
use App\Notifications\OrderPlaced;
use Notification;
use Auth;
use Session;
use Stripe;
use Validator;

class OrderTrailerController extends Controller
{
    //order trailer
    public function order_trailer(Request $request)
    {
        Validations::order_trailer($request);
        try {
            $user_id = Auth::id();
            $hire_time = explode(' - ', trim($request->date1));
            $start_time = date('Y-m-d h:i A', strtotime("$hire_time[0] $request->start_time"));
            $end_time = date('Y-m-d h:i A', strtotime("$hire_time[1] $request->end_time"));
            $start_date = $hire_time[0];
            $end_date = $hire_time[1];
            $trailor = $this->getTrailerById($request->trailer_id);
            $user = $this->getUserById($user_id);
            return view('frontend.book_trailer', compact('hire_time', 'start_date', 'end_date', 'start_time', 'end_time', 'trailor', 'user'));
        } catch (\Exception $exception) {
            toastError('Something went wrong, try again');
            return Redirect::back();
        }
    }

    //Get Trailer By id
    public function getTrailerById($id)
    {
        return Trailer::find($id);
    }

    //Get USER by id
    public function getUserById($id)
    {
        return User::find($id);
    }

    //check Available Date 
    public function check_date(Request $request)
    {
        $hire_time = explode(' - ', trim($request->c_date));
        $start_time = date('Y-m-d', strtotime("$hire_time[0]"));
        $end_time = date('Y-m-d', strtotime("$hire_time[1]"));
        $checkfullstartdaytime = false;
        $checkfullenddaytime = false;
        if ($start_time == $end_time) {
          
            $start_date = strtotime("$hire_time[0]");
            // $disable_time = Order::where('trailer_id', $request->trailer_id)->where('start_date', $hire_time[0])->orWhere('end_date', $hire_time[1])->get();
            $disable_time = Order::where('trailer_id', $request->trailer_id)->where( function($query) use ($hire_time){
                $query->orWhere('start_date', $hire_time[0])->orWhere('end_date', $hire_time[1]);
            })->get();

            $start_time = array();
            $end_time = array();
            foreach ($disable_time as $disable_t) {
                if ($disable_t->start_date !=  $disable_t->end_date) {
                    if ($hire_time[0] == $disable_t->start_date) {
                        $start_time[] = \Carbon\Carbon::parse($disable_t->start_time)->format('h:i A');
                        $start_time[] = "11:31pm";
                        $checkfullstartdaytime = true;
                    } elseif ($hire_time[0] == $disable_t->end_date) {
                        $start_time[] = "12:00am";
                        $start_time[] = \Carbon\Carbon::parse($disable_t->end_time)->format('h:i A');
                        $checkfullenddaytime = true;
                    }
                } else {
                    $start_time[] = \Carbon\Carbon::parse($disable_t->start_time)->format('h:i A');
                    $start_time[] = \Carbon\Carbon::parse($disable_t->end_time)->format('h:i A');
                }
            }
            if (count($disable_time) > 0) {
                return response()->json([
                    'success' => true,
                    'message' => $checkfullstartdaytime && $checkfullenddaytime ? 'Trailer already Booked in these Days.Kindly Select another date.' : 'Select Time',
                    'data' => $start_time,
                    'fulldaycheck' => $checkfullstartdaytime && $checkfullenddaytime ? 'full' : 'half'
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => 'select Time',
                    'data' => $disable_time
                ]);
            }
        } else {
            $start_date = $hire_time[0];
            $end_date = $hire_time[1];
            //if no order exist after end date
            $checknextdate = Order::where('trailer_id', $request->trailer_id)->Where('end_date', '>', $start_date)->first();
            if ($checknextdate) {
                $disable_time = Order::where('trailer_id', $request->trailer_id)
                    ->whereBetween('start_date', [$start_date, $end_date])
                    ->first();
                if ($disable_time == null) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Select Time',
                        'data' => null
                    ]);
                } else {
                    return response()->json([
                        'error' => true,
                        'message' => 'Trailer already Booked in these Days.Kindly Select another date.',
                        'data' => null
                    ]);
                }
            } else {
                $start_time = array();
                $disabletime = Order::where('trailer_id', $request->trailer_id)->where('end_date', $start_date)->latest()->first();
                if ($disabletime) {
                    $start_time[] = "12:00am";
                    $start_time[] = $disabletime->end_time;
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Select Time',
                    'data' => $start_time
                ]);
            }
        }
    }

    //check drop time avilablity
    public function check_drop_time(Request $request)
    {
        $dates = explode(' - ', trim($request->c_date)); 
        $start_date = $dates[0];
        $end_date = $dates[1];
        $pickTime = $request->pick_time;
        $trailerId = $request->trailer_id;
        $endPickupDateTime = strtotime("$end_date $pickTime");


        $afterPickupOrder = Order::where('trailer_id' ,  $trailerId)->where('start_time_strtotime' ,">" , $endPickupDateTime)->where('start_date' , $start_date)->orderBy('start_time_strtotime' ,'asc')->first();

        // dd($afterPickupOrder , $endPickupDateTime);
        
        if($afterPickupOrder)
        {
            $disableTime =  [ null , $pickTime , $afterPickupOrder->start_time , '11:31pm'];
        }
        else
        {
            $disableTime =  [ "12:00am" , $pickTime];
        }

        return response()->json([
                    'success' => true,
                    'message' => 'please select drop time',
                    'data' => $disableTime,
                ]);
    }


    //store driving licence
    // public function store_licence(Request $request)
    // {
    //     $rules = array('driving_licence' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048');
    //     $validator = Validator::make($request->all(), $rules);
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 'Error',
    //             'message' => 'Input filed required',
    //             'data' => null,
    //             'redirectURL' => '',
    //         ], 400);
    //     }
    //     $code = $request->code;
    //     try {
    //         $user_id = Auth::id();
    //         $user = $this->getUserById($user_id);
    //         if ($request->hasfile('driving_licence')) {
    //             $filePath = 'uploads/driving_licence/';
    //             $image_name = HelperFunctions::saveFile(null, $request->file('driving_licence'), $filePath);
    //             $user->driving_licence = $image_name;
    //             $user->save();
    //         }

    //         if ($request->code) {
    //             $couponsData = Coupon::where(['code' => $request->code])->first();
    //             if ($couponsData) {
    //                 if ($couponsData->toal_count > $couponsData->use_count) {
    //                     $value = $couponsData->value;
    //                 } else {
    //                     return response()->json([
    //                         'status' => 'Error',
    //                         'message' => 'Coupon EXpired or Max count reached',
    //                         'data' => null,
    //                         'redirectURL' => '',
    //                     ], 400);
    //                 }
    //             } else {
    //                 return response()->json([
    //                     'status' => 'Error',
    //                     'message' => 'Coupon Code not found',
    //                     'data' => null,
    //                     'redirectURL' => '',
    //                 ], 400);
    //             }
    //         }

    //         $this->successResponse($user, 'Driving Licence Uploaded', 200);
    //     } catch (\Exception $exception) {
    //         $this->errorResponse('Something Went Wrong', 400);
    //     }
    // }

    //check coupon
    public function checkcoupon(Request $request)
    {
        if ($request->code) {
            //check coupon code
            $couponsData = Coupon::where(['code' => $request->code])->first();
            if ($couponsData) {
                if ($couponsData->toal_count > $couponsData->use_count) {
                    $value = $couponsData->value;
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Coupon Applied',
                        'data' => $value,
                        'redirectURL' => '',
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 'Error',
                        'message' => 'Coupon Not Valid',
                        'data' => null,
                        'redirectURL' => '',
                    ], 400);
                }
            } else {
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Coupon Code Invalid',
                    'data' => null,
                    'redirectURL' => '',
                ], 400);
            }
        } else {
            return response()->json([
                'status' => 'Error',
                'message' => 'Coupon Not Found',
                'data' => null,
                'redirectURL' => '',
            ], 400);
        }
    }
    //checkout 
    public function order_checkout(Request $request)
    {
        $trailer_id = $request->trailer_id;
        $start_time = $request->start_time;
        $end_time = $request->end_time;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $code = $request->code;
        $value = '';
        if ($code) {
            $couponsData = Coupon::where(['code' => $request->code])->first();
            if ($couponsData) {
                if ($couponsData->toal_count > $couponsData->use_count) {
                    $value = $couponsData->value;
                }
            }
        }
        return view('frontend.order-checkout', compact('value', 'trailer_id', 'start_time', 'end_time', 'start_date', 'end_date', 'code'));
    }
    //submit order
    public function orderSubmit(Request $request)
    {
        if (isset($request->licence_uploaded)) {
            $request->validate([
                'driving_licence' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
        }
        $user_id = Auth::id();
        $user = $this->getUserById($user_id);
        if ($request->hasfile('driving_licence')) {

            $filePath = 'uploads/driving_licence/';
            $image_name = HelperFunctions::saveFile(null, $request->file('driving_licence'), $filePath);
            $user->driving_licence = $image_name;
            $user->save();
        }
        $order = new Order();
        $amount = $request->amount;
        if ($request->coupon_code) {
            $coupon = Coupon::where(['code' => $request->coupon_code])->first();
            // dd("inside coupon" , $coupon , $coupon->use_count ,$coupon->toal_count );
            $today = date("Y-m-d");
            // dd($coupon->expired_at < $today);
            if($today >= $coupon->expired_at)
            {
                return redirect()->back()->with('error', 'COUPON EXPIRED!');
            }

            if($coupon->use_count  == $coupon->toal_count)
            {
                return redirect()->back()->with('error', 'MAX COUPON USED!');
            }
            $order->coupon_id = $coupon->id;
            $order->discount_price = $coupon->value;
            $coupon->use_count = ++$coupon->use_count;
            if($coupon->value>$amount)
            {
                $amount=0;
            }
            else{
                $amount=$amount-$coupon->value;
            }
        }
        $amount = $amount + 150;
        try {
            Stripe\Stripe::setApiKey('sk_test_xfxl874azsZucvkjAQP6sExu');
            $stripedata = Stripe\Charge::create([
                "amount" => $amount * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "This payment is for obaid purpose"
            ]);
            if ($stripedata->status == "succeeded") {
                $user_id = Auth::id();
                $user = $this->getUserById($user_id);
                $trailor = $this->getTrailerById($request->trailer_id);
                $order->user_id = $user_id;
                $order->trailer_id = $request->trailer_id;
                $order->amount = $request->amount;
                $order->charges = 150;
                $order->start_time = $request->start_time;
                $order->end_time = date('h:i A', strtotime('+1 minutes', strtotime($request->end_time)));
                $order->start_time_strtotime = strtotime("$request->start_date $request->start_time");
                $order->end_time_strtotime = strtotime("$request->end_date $request->end_time");
                $order->start_date = $request->start_date;
                $order->end_date = $request->end_date;
                $order->payment_status = 1;
                $order->payment_method = "Stripe";
                $order->status = "New Order";
                if ($order->save()) {
                    if ($request->coupon_code) {
                        $coupon->save();
                    }
                    Notification::route('mail', $user->email)->notify(new OrderPlaced($trailor->pass_key,'user'));
                    Notification::route('mail', 'admin@gmail.com')->notify(new OrderPlaced($trailor->pass_key,'admin',$user));
                    $orderData = Order::with('user', 'trailer')->find($order->id);
                    $start_time = date('Y-m-d h:i A', strtotime("$order->start_date $request->start_time"));
                    $end_time = date('Y-m-d h:i A', strtotime("$order->end_date $request->end_time"));
                    $hours = HelperFunctions::getHirePeriodTimes($start_time, $end_time);
                    return view('frontend.order-sucess', compact('orderData', 'hours'));
                }
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'ERROR .. !  ' . $exception->getMessage() . '.');
        }
    }

    //order success
    public function orderSuccess($orderid = null)
    {
        $orderData = Order::with('user', 'trailer')->find($orderid);
        return view('frontend.order-sucess', compact('orderData'));
    }
    //User Bookings
    public function UserBooking(Request $request)
    {
        try {
            if (isset($request->trailer) || isset($request->sort)) {
                $sort = $request->sort == "" ? 'asc' : $request->sort;
                if (!empty($request->trailer)) {
                    $orderData = Order::with('user', 'trailer')->where(['user_id' => Auth::id(), 'trailer_id' => $request->trailer])->orderBy('id', $sort)->get();
                } else {
                    $orderData = Order::with('user', 'trailer')->where(['user_id' => Auth::id()])->orderBy('id', $sort)->get();
                }
            } else {
                $orderData = Order::with('user', 'trailer')->where(['user_id' => Auth::id()])->get();
            }
            $trailer = Trailer::get();
            return view('frontend.userDashboard.my_booking', compact('orderData', 'trailer'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'ERROR .. !  ' . $exception->getMessage() . '.');
        }
    }
    //destroy order
    public function destroy(Request $request, $order)
    {
        try {
            Order::find($order)->delete();
            return redirect()->back()->with('success', 'Success .. ! Order Deleted');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'ERROR .. !  ' . $exception->getMessage() . '.');
        }
    }

    //paypal transaction
    public function paypal_transaction(Request $request)
    {
    }
    //pick and upload photo 
    public function OrderPickTrailer($id)
    {
        return view('frontend.pick-trailer', compact('id'));
    }

    //upload photo
    public function Order_Pick_Trailer_Upload_Photo(Request $request)
    {
        $request->validate([
            'images.*' => 'required|mimes:jpeg,png,PNG,jpg,gif|min:1',

        ]);
        //upload car images
        $image_links = [];
        if ($request->file('images')) {
            $files = $request->file('images');
            foreach ($files  as $key => $file) {
                $filePath = 'uploads/trailer/images/';
                $imagename = HelperFunctions::saveFile(null, $file, $filePath);
                $image_links[] = $imagename;
            }
        }
        $model = new OrderPickupTrailerImage();
        $model->images = json_encode($image_links);
        $model->user_id = Auth::user()->id;
        $model->order_id = $request->order_id;
        if ($model->save()) {
            Order::find($request->order_id)->update(['status' => 'Pick Up']);
            \Mail::to('admin@gmail.com')->send(new TrailerRefunMail());
            return redirect('User/my_booking')->with('sucess', 'Success .. !  Images Uploaded');
        }
    }

    //upload photo and return trailer
    public function OrderReturnTrailer(Request $request, $id)
    {
        return view('frontend.photo_uploaded', compact('id'));
    }

    //upload photo
    public function Order_Trailer_Upload_Photo(Request $request)
    {
        $request->validate([
            'images.*' => 'required|mimes:jpeg,png,PNG,jpg,gif|min:1',

        ]);
        //upload car images
        $image_links = [];
        if ($request->file('images')) {
            $files = $request->file('images');
            foreach ($files  as $key => $file) {
                $filePath = 'uploads/trailer/images/';
                $imagename = HelperFunctions::saveFile(null, $file, $filePath);
                $image_links[] = $imagename;
            }
        }
        $model = new OrderReturnTrailerImage();
        $model->images = json_encode($image_links);
        $model->user_id = Auth::user()->id;
        $model->order_id = $request->order_id;
        if ($model->save()) {
            Order::find($request->order_id)->update(['status' => 'Refund Request']);
            \Mail::to('admin@gmail.com')->send(new TrailerRefunMail());
            return redirect('User/my_booking')->with('sucess', 'Success .. !  Images Uploaded');
        }
    }
}
