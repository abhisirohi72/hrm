<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\OrderHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\CartSetting;
use App\Models\Discount;
use App\Models\OrderDiscount;

class RazorpayPaymentController extends Controller
{
    public function index($order_id, $total_price, $final_price, $coupon_id = null)
    {
        $actual_price = $total_price; // Store the actual price before any discounts
        if (!$order_id) {
            return redirect()->route('view.cart')->with('error', 'Order ID is required.');
        }
        $total_price = OrderHistory::where('order_unique_id', $order_id)->sum('t_price');
        if (!$total_price) {
            return redirect()->route('view.cart')->with('error', 'No order found for this ID.');
        }

        //for GST calculation
        $isGstEnable = CartSetting::where("id", 1)->first();
        if ($isGstEnable->gst == "1") {
            // Calculate GST if enabled
            $gstAmount = ($total_price * $isGstEnable->gst) / 100; // Assuming GST is 18%
            $total_price = $total_price + $gstAmount;
        }

        //for coupon calculation
        if ($coupon_id) {
            // Check if the coupon code exists and is valid
            $coupon_query = Discount::where('id', $coupon_id)
                ->where('status', 'active')
                ->where('start_date', '<=', date("Y-m-d"))
                ->where('end_date', '>=', date("Y-m-d"))
                ->where("is_used", '0')
                ->first();
            if ($coupon_query) {
                if ($coupon_query->discount_type === 'percentage') {
                    // echo ($request->input('total_amount') * $coupon->discount_value);
                    $discount = ($total_price * $coupon_query->discount_value) / 100;
                } else {
                    $discount = $coupon_query->value;
                }
                $total_price = $total_price - $discount;    
            }
        }

        $main_price = $total_price; // Store the main price before any discounts
        $total_price = $total_price * 100; // Convert to paise for Razorpay
        $user_details = User::where('id', session('user'))->first();
        return view('razorpay', [
            'order_id' => $order_id,
            'total_price' => $total_price,
            'main_price' => $main_price,
            'user_details' => $user_details,
            'coupon_id' => $coupon_id,
            'actual_price' => $actual_price,
        ]);
    }

    public function payment(Request $request)
    {
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        $payment = $api->payment->fetch($request->razorpay_payment_id);
        // echo ;
        // echo "<pre>";
        // print_r($payment);
        // echo "</pre>";
        // exit;

        if ($payment->status == 'authorized') {
            $payment->capture(['amount' => $payment->amount]);
            $isGstEnable = CartSetting::where("id", 1)->first();
            if (!empty($payment->notes->coupon_id)) {
                $coupon = Discount::where('id', $payment->notes->coupon_id)
                    ->where('status', 'active')
                    ->where('start_date', '<=', date("Y-m-d"))
                    ->where('end_date', '>=', date("Y-m-d"))
                    ->where("is_used", '0')
                    ->first();
                if ($coupon) {
                    // Calculate the discount based on the coupon type
                    if ($coupon->discount_type === 'percentage') {
                        // echo ($request->input('total_amount') * $coupon->discount_value);
                        $discount = ($payment->notes->actual_price * $coupon->discount_value) / 100;
                    } else {
                        $discount = $coupon->value;
                    }
                }

                $discount_update = Discount::where("id", $payment->notes->coupon_id)->update([
                    "is_used"   =>  "1"
                ]);

                $order_discount= OrderDiscount::create([
                    "order_unique_id"   =>  $payment->notes->order_id,
                    "discount_id"       =>  $payment->notes->coupon_id,
                ]);
            }
            $insert = Cart::create([
                "transaction_id"    =>  $payment->id,
                "order_unique_id"   =>  $payment->notes->order_id,
                "user_id"           =>  session("user"),
                "payment_mode"      =>  'online',
                "order_status"      =>  "success",
                "total_price"       =>  $payment->notes->actual_price, // Convert back to rupees
                "discount"          =>  $discount ?? '0.00',
                "final_price"       =>  $payment->amount / 100,
                "gst"               =>  $isGstEnable->gst,
                "coupon_id"         =>  $payment->notes->coupon_id,
            ]);
            OrderHistory::where("order_unique_id", $payment->notes->order_id)->update([
                "is_placed" => "1",
            ]);
            // store in DB if needed
            return back()->with('success', 'Payment successful!');
        }

        return back()->with('error', 'Payment failed!');
    }

    // public function razorpayDetails(Request $request)
    // {
    //     $copun_enabled=0;
    //     if(!empty($request->coupon_id)){
    //         $copun_enabled=1;
    //     }
    //     return response()->json([
    //         'copun_enabled' => $copun_enabled,
    //         'order_id' => $request->order_id,
    //     ]);
    // }
}
