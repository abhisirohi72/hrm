<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CartSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CartSettingController extends Controller
{
    public function addCartSetting() :View
    {
        $main_title = "Admin-Add-Cart-Setting";
        $title = "Add Cart Setting";

        $details = CartSetting::first();

        return view('admin.cart_setting.add', [
            'main_title' => $main_title,
            'title' => $title,
            'details' => $details
        ]);
    }

    public function saveCartSetting(Request $request)
    {
        $request->validate([
            'gst' => 'required',
        ]);

        CartSetting::updateOrCreate(
            ['id' => 1],
            [
                'gst'                   => $request->input('gst'),
                'wallet_payment_mode'   => $request->input('wallet_payment_mode') ?? '0',
                'cod_payment_mode'      => $request->input('cod_payment_mode') ?? '0',
                'online_payment_mode'   => $request->input('online_payment_mode') ?? '0',
            ]
        );

        return redirect()->route('add.cart.setting')->with('success', 'Cart setting saved successfully.');
    }
}
