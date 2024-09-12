<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{route('admin.general-setting-update')}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="site_name">Site Name</label>
                    <input type="text" class="form-control" name="site_name" value="{{@$generalSetting->site_name}}">
                </div>
                <div class="form-group">
                    <label for="contact_email">Contact Email</label>
                    <input type="text" class="form-control" name="contact_email" value="{{@$generalSetting->contact_email}}">
                </div>
                <div class="form-group">
                    <label for="currency_name">Default Currency Name</label>
                    <select id="" name="currency_name" class="form-control select2">
                        <option value="">Select</option>
                        @foreach (config('setting.currency_list') as $currency)
                            <option {{@$generalSetting->currency_name == $currency ? 'selected' : ' '}} value="{{$currency}}">{{$currency}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="currency_icon">Currency Icon</label>
                    <input type="text" class="form-control" name="currency_icon" value="{{@$generalSetting->currency_icon}}">
                </div>
                <div class="form-group">
                    <label for="timezone">Timezone</label>
                    <select id="" class="form-control select2" name="timezone">
                        <option value="">Select</option>
                        @foreach (config('setting.timezone') as $key => $timezone)
                            <option {{@$generalSetting->timezone == $key ? 'selected' : ' '}} value="{{$key}}">{{$key}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>