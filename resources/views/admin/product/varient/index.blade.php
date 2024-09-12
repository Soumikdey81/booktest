@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Product Varient</h1>
    </div>
    <div class="mb-3">
        <a href="{{route('admin.product.index')}}" class="btn btn-primary">Back</a>
      </div>
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>All Product Varients</h4>
              <div class="card-header-action">
                <a class="btn btn-primary" href="{{route('admin.product-varient.create')}}">+Create New</a>
              </div>
            </div>
            <div class="card-body">
              {{$dataTable->table()}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush