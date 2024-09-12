<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{route('admin.razorpay-setting.update', 1)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="site_name">RazorPay Status </label>
                    <select name="status" id="" class="form-control">
                        <option {{$razorpaySetting->status == 1 ? 'selected' : ''}} value="1">Enadle</option>
                        <option {{$razorpaySetting->status == 0 ? 'selected' : ''}} value="0">Disable</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="country_name">Country Name</label>
                    <select id="" name="country_name" class="form-control select2">
                        <option value="">Select</option>
                        @foreach (config('setting.country_list') as  $country)
                            <option {{$razorpaySetting->country_name == $country ? 'selected' : ' '}} value="{{$country}}">{{$country}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="currency_name">Currency Name</label>
                    <select id="" name="currency_name" class="form-control select2">
                        <option value="">Select</option>
                        @foreach (config('setting.currency_list') as $key => $currency)
                            <option {{$razorpaySetting->currency_name == $currency ? 'selected' : ' '}} value="{{$currency}}">{{$key}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="razorpay_key">Razorpay Key</label>
                    <input type="text" class="form-control" name="razorpay_key" value="{{$razorpaySetting->razorpay_key}}">
                </div>
                <div class="form-group">
                    <label for="razorpay_secret_key">Razorpay Secret Key</label>
                    <input type="text" class="form-control" name="razorpay_secret_key" value="{{$razorpaySetting->razorpay_secret_key}}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
{{-- {{$razorpaySetting->status == 1 ? 'selected' : ''}} --}}
{{-- {{$razorpaySetting->currency_name == $currency ? 'selected' : ' '}}  --}}