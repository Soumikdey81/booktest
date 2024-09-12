@extends('frontend.dashboard.layouts.master')
@section('content')
<div class="col-auto flex-grow-1 p-3 ps-5 col-md-8">
    <div class="card address">
        <div class="card-header">
            <p class="cart-header fs-3 m-0 fw-bold">Edit Address</p>
        </div>
        <div class="card-body">
            <form action="{{route('user.address.update', $address->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label cart-header fw-bold">Name</label>
                    <input type="text" class="form-control cart-text fw-bold" id="name" name="name" value="{{$address->name}}">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label cart-header fw-bold">Email</label>
                    <input type="email" class="form-control cart-text fw-bold" id="email" name="email" value="{{$address->email}}">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label cart-header fw-bold">Phone</label>
                    <input type="tel" class="form-control cart-text fw-bold" id="phone" name="phone" value="{{$address->phone}}">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label cart-header fw-bold">Address</label>
                    <textarea type="text" class="form-control cart-text fw-bold" id="address" name="address">{{$address->address}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="landmark" class="form-label cart-header fw-bold">Landmark</label>
                    <textarea type="text" class="form-control cart-text fw-bold" id="landmark" name="landmark">{{$address->landmark}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label cart-header fw-bold">City</label>
                    <input type="text" class="form-control cart-text fw-bold" id="city" name="city" value="{{$address->city}}">
                </div>
                <div class="mb-3">
                    <label for="pincode" class="form-label cart-header fw-bold">Pincode</label>
                    <input type="text" class="form-control cart-text fw-bold" id="pincode" name="pincode" value="{{$address->pincode}}">
                </div>
                <div class="mb-3">
                    <label for="district" class="form-label cart-header fw-bold">District</label>
                    <input type="text" class="form-control cart-text fw-bold" id="district" name="district" value="{{$address->district}}">
                </div>
                <div class="mb-3">
                    <label for="state" class="form-label cart-header fw-bold">State</label>
                    <select name="state" id="state" class="form-control cart-text fw-bold select2">
                        <option class="cart-text fw-bold" value="">Select</option>
                        @foreach (config('setting.state_list') as $state)
                            <option class="cart-text fw-bold" {{$address->state == $state ? 'selected' : ''}} value="{{$state}}">{{$state}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label cart-header fw-bold">Type of Address</label>
                    <select name="type" id="type" class="form-control cart-text fw-bold">
                        <option {{$address->type == 'Home' ? 'selected' : ''}} value="Home">Home</option>
                        <option {{$address->type == 'Work' ? 'selected' : ''}} value="Work">Work</option>
                    </select>
                </div>
                <button type="submit" class="d-grid col-12 btn btn-sm btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection