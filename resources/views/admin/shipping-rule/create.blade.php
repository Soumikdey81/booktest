@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Shipping Rule</h1>
    </div>
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Create Shipping Rule</h4>
            </div>
            <div class="card-body">
                <form action="{{route('admin.shipping-rule.store')}}" method="POST">
                  @csrf
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{old('name')}}">
                  </div>
                  <div class="form-group">
                    <label for="inputStatus">Type</label>
                    <select id="inputStatus" class="form-control shipping-type" name="type">
                        <option value="flat_cost">Flat Cost</option>
                        <option value="min_cost">Minimum Order Amount</option>
                    </select>
                  </div>
                  <div class="form-group min_cost d-none">
                    <label for="name">Minimum Amount</label>
                    <input type="text" class="form-control" name="min_cost" value="">
                  </div>
                  <div class="form-group">
                    <label for="name">Cost</label>
                    <input type="text" class="form-control" name="cost" value="">
                  </div>
                  <div class="form-group">
                    <label for="inputStatus">Status</label>
                    <select id="inputStatus" class="form-control" name="status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  <script>
    $(document).ready(function(){
        $('body').on('change', '.shipping-type', function(){
            let value = $(this).val();
            if(value != 'min_cost'){
                $('.min_cost').addClass('d-none');
            }else{
                $('.min_cost').removeClass('d-none');
            }
        })
    })
  </script>
@endpush