@extends('frontend.dashboard.layouts.master')
@section('content')
<div class="col-auto flex-grow-1 p-3 ps-5 col-md-8">
    <h1 class="fw-bold fs-3 cart-header">My Addresses</h1>
    <div class="row d-flex justify-content-between align-items-start">
        @php
            $index = 0;
        @endphp
        @foreach ($addresses as $address)
            @php
                $index +=1;
            @endphp
            <div class="card address col-12 my-2">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="cart-header m-0 fw-bold">Address: {{$index}}</p>
                    <i class="badge bg-badge">{{$address->type}}</i>
                </div>
                <div class="card-body cart-text">
                    <b>Name: </b>{{ $address->name }}<br>
                    <b>Email: </b>{{ $address->email }}<br>
                    <b>Phone: </b>{{ $address->phone }}<br>
                    <b>Address: </b>{{ $address->address }}<br>
                    <b>Landmark: </b>{{ $address->landmark }}<br>
                    <b>Pincode: </b>{{ $address->pincode }}<br>
                    <b>City: </b>{{ $address->city }}<br>
                    <b>District: </b>{{ $address->district }}<br>
                    <b>State: </b>{{ $address->state }}<br>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{route('user.address.edit', $address->id)}}" class="btn fw-bold w-50 me-2 button">Edit</a>
                    <a href="{{route('user.address.destroy', $address->id)}}" class="btn fw-bold w-50 ms-2 button delete-item">Delete</a>
                </div>
            </div>
        @endforeach
    </div>
    <a href="{{route('user.address.create')}}" class="btn button px-2 fw-bold mt-3"><i class="fas fa-plus pe-3"></i>Add New Address</a>
</div>
@endsection