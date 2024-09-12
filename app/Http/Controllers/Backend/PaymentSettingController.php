<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\RazorpaySetting;
use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{
    public function index(){
        $razorpaySetting = RazorpaySetting::first();
        return view('admin.payment-setting.index', compact('razorpaySetting'));
    }
}
