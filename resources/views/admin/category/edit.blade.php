@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Category</h1>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Edit Category</h4>
            </div>
            <div class="card-body">
                <form action="{{route('admin.category.update', $category->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label for="category_name">Name</label>
                      <input type="text" class="form-control" name="category_name" value="{{ $category->name }}">
                    </div>
                    <div class="form-group">
                        <label for="inputStatus">Status</label>
                        <select id="inputStatus" class="form-control" name="status">
                            <option {{$category->status == 1 ? 'selected' : ''}} value="1">Active</option>
                            <option {{$category->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection