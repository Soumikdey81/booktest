@extends('frontend.dashboard.layouts.master')
@section('content')
<div class="col-auto flex-grow-1 p-3 ps-5 col-md-8">
    <div class="card">
        <div class="card-header">
            <p class="fs-3 p-2 header">Create New Address</p>
        </div>
        <div class="card-body">
            <form action="{{route('user.address.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="tel" class="form-control" id="phone" name="phone">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea type="text" class="form-control" id="address" name="address"></textarea>
                </div>
                <div class="mb-3">
                    <label for="landmark" class="form-label">Landmark</label>
                    <textarea type="text" class="form-control" id="landmark" name="landmark"></textarea>
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" name="city">
                </div>
                <div class="mb-3">
                    <label for="pincode" class="form-label">Pincode</label>
                    <input type="text" class="form-control" id="pincode" name="pincode">
                </div>
                <div class="mb-3">
                    <label for="district" class="form-label">District</label>
                    <input type="text" class="form-control" id="district" name="district">
                </div>
                <div class="mb-3">
                    <label for="state" class="form-label">State</label>
                    <select name="state" id="state" class="form-control select2">
                        <option value="">Select</option>
                        @foreach (config('setting.state_list') as $state)
                            <option value="{{$state}}">{{$state}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Type of Address</label>
                    <select name="type" id="type" class="form-control">
                        <option value="Home">Home</option>
                        <option value="Work">Work</option>
                    </select>
                </div>
                <button type="submit" class="d-grid col-12 btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection