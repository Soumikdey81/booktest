@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Banner</h1>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Edit Banner</h4>
            </div>
            <div class="card-body">
                <form action="{{route('admin.banner.update', $banner->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label for="banner_preview">Preview</label>
                    <br>
                    <img width="100px" src="{{asset($banner->banner_image)}}" alt="">
                  </div>
                  <div class="form-group">
                    <label for="banner_image">Banner Image</label>
                    <input type="file" class="form-control" name="banner_image">
                  </div>
                  <div class="form-group">
                    <label for="banner_title">Banner Header</label>
                    <input type="text" class="form-control" name="banner_title" value="{{$banner->banner_title}}">
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