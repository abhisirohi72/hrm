<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartSetting;
use App\Models\Category;
use App\Models\Discount;
use App\Models\OrderDiscount;
use App\Models\OrderHistory;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EcommerceController extends Controller
{
    public function eCommerce(Request $request)
    {
        $query = Category::with('products');

        if ($request->filled('products')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $category = $query->paginate(12);
        // $categories = Category::all();
        // echo "<pre>";
        // print_r($category);
        // exit;

        // Fetch stock list (all products with quantity)
        $stockList = Product::select('name', 'quantity')->orderBy('name')->get();

        return view("ecommerce.main", [
            // 'categories'    =>  $categories,
            'categories'      =>  $category,
            'stockList'     =>  $stockList,
        ]);
    }

    public function addToCart($prod_id, Request $request){
        //check user is loggedin or not
        if (!filled(session('user'))) {
            return redirect()->route('login.form');
        }

        // DB::enableQueryLog();
        $query = Product::with(['category'])->where("id", $prod_id)->first();
        // dd(DB::getQueryLog());
        // echo "<pre>";
        // print_r($query);
        // exit;
        //check same user product is exist in cart or not
        $check = OrderHistory::where("user_id", session("user"))
                    ->where("is_deleted", '0')
                    ->where("is_placed", '0')
                    ->get();
        if ($check->isNotEmpty()) {
            $order_unique = $check->first()->order_unique_id;
        }else{
            $order_unique = "ORD".time().rand(1000,9999);
        }
        $order_generate = OrderHistory::create([
            "user_id"           =>  session("user"),
            "order_unique_id"   =>  $order_unique,
            "product_id"        =>  $prod_id,
            "p_price"           =>  $query->price,
            "qnty"              =>  1,
            "t_price"           =>  $query->price,
        ]);

        return redirect()->route("view.cart");
    }

    public function viewCart(){
        if (!filled(session('user'))) {
            return redirect()->route('login.form');
        }
        
        $query = OrderHistory::with('products')
                    ->where("user_id", session("user"))
                    ->where("is_deleted", "0")
                    ->where("is_placed", "0")
                    ->get();
        
        if ($query->isEmpty()) {
            return redirect()->route("e.commerce")->with("error", "Your cart is empty.");
        }

        $cart_setting = CartSetting::first();

        return view("ecommerce.cart_view",[
            "details"       =>  $query,
            "cart_setting"  => $cart_setting,
        ]);
    }

    public function removeCartItem($del_id){
        $delete = OrderHistory::where("id", $del_id)->update([
            "is_deleted"=>"1"
        ]);
        $details = OrderHistory::where("id", $del_id)->first();
        if ($delete) {
            $prod_details = Product::where("id", $details->product_id)->first();
            $prod_update = Product::where("id", $details->product_id)->update([
                    "quantity"  =>  ($prod_details->quantity+$details->qnty)
            ]);
        }

        return back()->with("success", "Deleted Successfully");
    }

    public function checkStock(Request $request){
        $get_data = $request->input("get_data");
        $pro_id = $request->input("pro_id");
        $order_id = $request->input("order_id");

        $details= Product::where("id", $pro_id)->first();

        if ($details->quantity >= $get_data) {
            //update in order history
            $update = OrderHistory::where("id", $order_id)->where("user_id", session("user"))
                ->where("is_deleted", "0")
                ->update([
                "qnty"      =>  $get_data,
                "t_price"   =>  $details->price * $get_data,
            ]);
            return response()->json([
                "status"        =>  "success",
                "message"       =>  "Stock is available",
                "quantity"      =>  $details->quantity,
                "price"         =>  number_format($details->price*$get_data, 2),
                "normal_price"  =>  ($details->price*$get_data)
            ]);
        } else {
            return response()->json([
                "status"    =>  "error",
                "message"   =>  "Stock is not available",
                "quantity"  =>  $details->quantity
            ]);
        }
    }

    public function applyCoupon(Request $request)
    {
        $couponCode = $request->input('discount_code');
        $discount = 0;

        // Check if the coupon code exists and is valid
        $coupon = Discount::where('name', $couponCode)
            ->where('status', 'active')
            ->where('start_date', '<=', date("Y-m-d"))
            ->where('end_date', '>=', date("Y-m-d"))
            ->where("is_used",'0')
            ->first();

        if ($coupon) {
            // Calculate the discount based on the coupon type
            if ($coupon->discount_type === 'percentage') {
                // echo ($request->input('total_amount') * $coupon->discount_value);
                $discount = ($request->input('total_amount') * $coupon->discount_value) / 100;
            } else {
                $discount = $coupon->value;
            }
            
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or expired coupon code.'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'discount' => $discount,
            'message' => 'Coupon applied successfully.',
            'coupon_id'=> $coupon ? $coupon->id : null,
        ]);
    }

    public function proceedToPay(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'total_price' => 'required',
                'final_price'   => 'required',
                'payment_method' => 'required',
                'order_id'  => 'required', 
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()->first()
                ]);
            }
            // exit;
            $order_status="pending";    
            $final_price = str_replace(",","",$request->input("final_price"));
            $discount = (!empty($request->input("discount")))?str_replace(",","",$request->input("discount")) ?? '0.00':'0.00';
            // exit;

            if($request->input("payment_method")=="wallet"){
                // Check if user has sufficient wallet balance
                $user = User::where('id', session('user'))->first();
                if ($user->wallet_balance < $final_price) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Insufficient wallet balance.'
                    ]);
                }else{
                    // Deduct the amount from user's wallet
                    $user->wallet_balance -= $final_price;
                    $user->save();
                    $order_status = "success";
                }
            }
            if($request->input("payment_method")=="cod"){
                // For Cash on Delivery, we can directly set the order status to pending
                $order_status = "success";
            }

            $isGstEnable = CartSetting::where("id", 1)->first();
            if($isGstEnable->gst == "1"){
                // Calculate GST if enabled
                $gstAmount = ($final_price * $isGstEnable->gst) / 100; // Assuming GST is 18%
                $request->merge(['final_price' => $final_price + $gstAmount]);
            }
            $insert = Cart::create([
                "order_unique_id"   =>  $request->input("order_id"),
                "user_id"           =>  session("user"),
                "payment_mode"      =>  $request->input("payment_method"),
                "order_status"      =>  $order_status,
                "total_price"       =>  str_replace(",","",$request->input("total_price")),
                "discount"          =>  $discount,
                "final_price"       =>  $final_price,
                "coupon_id"         =>  $request->input("coupon_id"),
                "gst"               =>  $isGstEnable->gst,
            ]);

            if($insert){
                if(!empty($request->input("coupon_id"))){
                    $discount_update = Discount::where("id", $request->input("coupon_id"))->update([
                        "is_used"   =>  "1"
                    ]);

                    $order_discount= OrderDiscount::create([
                        "order_unique_id"   =>  $request->input("order_id"),
                        "discount_id"       =>  $request->input("coupon_id"),
                    ]);
                }
                $update = OrderHistory::where("order_unique_id", $request->input("order_id"))->update([
                    "is_placed" => "1",
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Order placed successfully.',
                    'order_id' => $insert->id,
                ]);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to place order. Please try again.'
                ]);
            }

            
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while processing your request: ' . $th->getMessage()
            ]);
        }
    }
}
