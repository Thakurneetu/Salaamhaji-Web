<div class="card-body">
  <div class="row">
    <div class="form-group col-md-6 col-12">
      <label for="name">Name</label>
      <input type="text" name="name" value="{{old('name') ?? (@$customer->name ?? '')}}" 
      class="form-control @error('name') is-invalid @enderror" placeholder="Enter Customer Name">
      @error('name')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-6 col-12">
      <label for="email">Email</label>
      <input type="email" name="email" value="{{old('email') ?? (@$customer->email ?? '')}}" 
      class="form-control @error('email') is-invalid @enderror" placeholder="Enter Customer Email">
      @error('email')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <input type="hidden" id="code" name="country_code" value="+91">
    <div class="form-group col-md-6 col-12">
      <label for="phone">Mobile Number</label>
      <input type="text" id="phone" name="phone" oninput="onlyNumber(this)" 
      value="{{old('phone') ? old('country_code').old('phone') : (@$customer->phone ? @$customer->country_code . @$customer->phone : '+91')}}" 
      class="form-control @error('phone') is-invalid @enderror" placeholder="Enter Mobile Number">
      @error('phone')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-6 col-12">
      <label>Gender</label>
      <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
        <option value="" selected disabled>Select Gender</option>
        <option value="Male" {{@$customer->gender == 'Male' ? 'selected' : ''}}>Male</option>
        <option value="Female" {{@$customer->gender == 'Female' ? 'selected' : ''}}>Female</option>
      </select>
      @error('gender')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
  </div>
</div>

<div class="card-footer d-flex justify-content-center">
  <button type="submit" class="btn btn-success text_black">Save</button>
  <a href="{{ route('customer.index') }}" class="btn btn-secondary ml-3">Cancel</a>
</div>