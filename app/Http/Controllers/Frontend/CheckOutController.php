<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Auth;
use Cart;
use Illuminate\Support\Facades\Session;

class CheckOutController extends Controller
{
    public function index(){
        $cartItems = Cart::content();
        $addresses = UserAddress::where('user_id', Auth::user()->id)->get();
        return view('frontend.product.checkout', compact('addresses', 'cartItems'));
    }

    public function createAddress(Request $request){

        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'email'],
            'phone' => ['required', 'max:10'],
            'address' => ['required', 'max:255'],
            'landmark' => ['required', 'max:255'],
            'city' => ['required', 'max:255'],
            'pincode' => ['required', 'max:255'],
            'district' => ['required', 'max:255'],
            'state' => ['required', 'max:255'],
            'type' => ['required']
        ]);

        $address = new UserAddress();
        $address->user_id = Auth::user()->id;
        $address->name = $request->name;
        $address->email = $request->email;
        $address->phone = $request->phone;
        $address->address = $request->address;
        $address->landmark = $request->landmark;
        $address->city = $request->city;
        $address->pincode = $request->pincode;
        $address->district = $request->district;
        $address->state = $request->state;
        $address->type = $request->type;
        $address->save();

        toastr('Created Successfully', 'success');

        return redirect()->back();
    }

    public function getAddressDetails(Request $request){
        $address = userAddress::findOrFail($request->address_id);
        return response(['status' => 'success', 'address' => $address ]);
    }

    public function checkoutFormSubmit(Request $request){
        $request->validate([
            'shipping_address_id' => ['required', 'integer']
        ]);

        $address = UserAddress::findOrFail($request->shipping_address_id)->toArray();

        if($address){
            Session::put('address', $address);
        }

        return response(['status' => 'success', 'redirect_url' => route('user.payment')]);
    }
}
