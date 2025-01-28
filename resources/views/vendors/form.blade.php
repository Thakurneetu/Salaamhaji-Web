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
      <label for="email">Email</label>
      <input type="email" name="email" value="{{old('email') ?? (@$vendor->email ?? '')}}" 
      class="form-control @error('email') is-invalid @enderror" placeholder="Enter Vendor Email" required>
      @error('email')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-6 col-12">
      <label for="phone">Mobile Number</label>
      <input type="text" name="phone" value="{{old('phone') ?? (@$vendor->phone ?? '')}}" 
      class="form-control @error('phone') is-invalid @enderror" placeholder="Enter Mobile Number" required>
      @error('phone')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
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
      <input type="text" name="zip" value="{{old('zip') ?? (@$vendor->zip ?? '')}}" 
      class="form-control @error('zip') is-invalid @enderror" placeholder="Enter Zipcode" >
      @error('zip')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-6 col-12">
      <label>Country</label>
      <select name="country_id" id="country_id" class="form-control">
        <option value="" selected disabled>Select Country</option>
        @foreach($countries as $country)
          <option value="{{$country->id}}" 
          {{@$vendor->country_id ? (@$vendor->country_id == $country->id ? 'selected' : '') : ($country->id == 152 ? 'selected' : '')}}
          >{{$country->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-md-6 col-12">
      <label for="exampleInputFile">Upload Catalog</label>
      <div class="input-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="exampleInputFile" name="catalogue" required>
          <label class="custom-file-label" for="exampleInputFile">Select Catalog File</label>
        </div>
      </div>
    </div>
    @if(@$vendor->catalogue)
      <div class="form-group col-12">
        <a href="{{asset($vendor->catalogue)}}" target="_blank" rel="noopener noreferrer">
          <h5><u><i>Download Uploaded Catalog</i></u></h5>
        </a>
      </div>
    @endif
  </div>
</div>

<div class="card-footer d-flex justify-content-center">
  <button type="submit" class="btn btn-info">Save</button>
  <a href="{{ route('vendor-users.index') }}" class="btn btn-secondary ml-3">Cancel</a>
</div>