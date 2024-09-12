<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        $generalSetting = GeneralSetting::first();
        return view('admin.setting.index', compact('generalSetting'));
    }

    public function generalSettingUpdate(Request $request){

        $request->validate([
            'site_name' => ['required', 'max:255'],
            'contact_email' => ['required', 'max:255'],
            'currency_name' => ['required', 'max:255'],
            'currency_icon' => ['required', 'max:255'],
            'timezone' => ['required', 'max:255']
        ]);

        GeneralSetting::updateOrCreate(
            ['id' => 1],
            [
                'site_name' => $request->site_name,
                'contact_email' => $request->contact_email,
                'currency_name' => $request->currency_name,
                'currency_icon' => $request->currency_icon,
                'timezone' => $request->timezone,
            ]
        );

        toastr('Updated Successfully', 'success');

        return redirect()->back();
    }
}
