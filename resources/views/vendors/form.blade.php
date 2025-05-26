<div class="card-body">
  <div class="row">
    <div class="form-group col-md-6 col-12">
      <label for="name">Name</label>
      <input type="text" name="name" value="{{old('name') ?? (@$vendor->name ?? '')}}"
      class="form-control @error('name') is-invalid @enderror" placeholder="Enter Vendor Name" required>
      @error('name')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-6 col-12">
    </div>
    <div class="form-group col-md-6 col-12">
      <label for="email">Email</label>
      <input type="email" name="email" value="{{old('email') ?? (@$vendor->email ?? '')}}"
      class="form-control @error('email') is-invalid @enderror" placeholder="Enter Vendor Email" required>
      @error('email')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-6 col-12">
      <label for="phone">Mobile Number</label>
      <input type="text" name="phone" oninput="onlyNumber(this)" value="{{old('phone') ?? (@$vendor->phone ?? '')}}"
      class="form-control @error('phone') is-invalid @enderror" placeholder="Enter Mobile Number" required>
      @error('phone')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="col-12"><h1>Address</h1></div>
    <div class="form-group col-md-6 col-12">
      <label for="name">Address Line 1</label>
      <input type="text" name="address1" value="{{old('address1') ?? (@$vendor->address1 ?? '')}}"
      class="form-control @error('address1') is-invalid @enderror" placeholder="Enter Address Line 1" >
      @error('address1')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-6 col-12">
      <label for="name">Address Line 2</label>
      <input type="text" name="address2" value="{{old('address2') ?? (@$vendor->address2 ?? '')}}"
      class="form-control @error('address2') is-invalid @enderror" placeholder="Enter Address Line 2" >
      @error('address2')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-6 col-12">
      <label for="name">City</label>
      <input type="text" name="city" value="{{old('city') ?? (@$vendor->city ?? '')}}"
      class="form-control @error('city') is-invalid @enderror" placeholder="Enter City Name" >
      @error('city')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-6 col-12">
      <label for="name">State</label>
      <input type="text" name="state" value="{{old('state') ?? (@$vendor->state ?? '')}}"
      class="form-control @error('state') is-invalid @enderror" placeholder="Enter State Name" >
      @error('state')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-6 col-12">
      <label for="name">Zipcode</label>
      <input type="text" name="zip" oninput="onlyNumber(this)" value="{{old('zip') ?? (@$vendor->zip ?? '')}}"
      class="form-control @error('zip') is-invalid @enderror" placeholder="Enter Zipcode" >
      @error('zip')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-6 col-12">
      <label for="country_id">Country</label>
      <select name="country_id" id="country_id" class="form-control" @error('state') is-invalid @enderror>
        <option value="" selected disabled>Select Country</option>
        @foreach($countries as $country)
          <option value="{{$country->id}}"
          {{@$vendor->country_id ? (@$vendor->country_id == $country->id ? 'selected' : '') : ($country->id == 152 ? 'selected' : '')}}
          >{{$country->name}}</option>
        @endforeach
      </select>
      @error('country_id')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="col-12"><h1>Service</h1></div>
    <div class="form-group col-md-6 col-12" >
      <label for="service">Select Service</label>
      <input type="hidden" name="services" id="service" value="{{@$vendor->services}}">
      <div class="" id="services"></div>
      @error('services')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-6 col-12" id="Laundry-div" @if(isset($services) && in_array('Laundry',$services )) style="display:block;" @else style="display:none;" @endif>
      <label for="exampleInputFile">Upload Laundry Catalog</label>
      <div class="input-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="Laundry" name="laundry_catalogue">
          <label class="custom-file-label" for="exampleInputFile">Select Catalog File</label>
        </div>
      </div>
    </div>
    <div class="form-group col-md-6 col-12" id="Food-div" @if(isset($services) && in_array('Food',$services )) style="display:block;" @else style="display:none;" @endif>
      <label for="exampleInputFile">Upload Food Catalog</label>
      <div class="input-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="Food" name="food_catalogue">
          <label class="custom-file-label" for="exampleInputFile">Select Catalog File</label>
        </div>
      </div>
    </div>
    <div class="form-group col-md-6 col-12" id="CAB-div" @if(isset($services) && in_array('CAB',$services )) style="display:block;" @else style="display:none;" @endif>
      <label for="cab_catalogue">Upload CAB Catalog</label>
      <div class="input-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="CAB" name="cab_catalogue">
          <label class="custom-file-label" for="cab_catalogue">Select Catalog File</label>
        </div>
      </div>
    </div>
    @if(isset($services))
      @if(in_array('Laundry',$services) && $vendor->laundry_catalogue)
        <div class="form-group col-12">
          <h5>
            <a href="{{asset($vendor->laundry_catalogue)}}" target="_blank" rel="noopener noreferrer">
              <u><i>Download/View Uploaded Laundry Catalog</i></u>
            </a>
          </h5>
        </div>
      @endif
      @if(in_array('Food',$services) && $vendor->food_catalogue)
        <div class="form-group col-12">
          <h5>
            <a href="{{asset($vendor->food_catalogue)}}" target="_blank" rel="noopener noreferrer">
              <u><i>Download/View Uploaded Food Catalog</i></u>
            </a>
          </h5>
        </div>
      @endif
      @if(in_array('CAB',$services) && $vendor->cab_catalogue)
        <div class="form-group col-12">
          <h5>
            <a href="{{asset($vendor->cab_catalogue)}}" target="_blank" rel="noopener noreferrer">
              <u><i>Download/View Uploaded CAB Catalog</i></u>
            </a>
          </h5>
        </div>
      @endif
    @endif
  </div>
</div>

<div class="card-footer d-flex justify-content-center">
  <button type="submit" class="btn btn-success text_black">Save</button>
  <a href="{{ route('vendor-users.index') }}" class="btn btn-secondary ml-3">Cancel</a>
</div>
