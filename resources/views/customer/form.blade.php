<div class="card-body">
  <div class="row">
    <div class="form-group col-md-6 col-12">
      <label for="name">Name</label>
      <input type="text" name="name" value="{{old('name') ?? (@$customer->name ?? '')}}" 
      class="form-control @error('name') is-invalid @enderror" placeholder="Enter Customer Name" required>
      @error('name')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-6 col-12">
      <label for="email">Email</label>
      <input type="email" name="email" value="{{old('email') ?? (@$customer->email ?? '')}}" 
      class="form-control @error('email') is-invalid @enderror" placeholder="Enter Customer Email" required>
      @error('email')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-6 col-12">
      <label for="phone">Country Code</label>
      <input type="text" name="country_code" value="{{old('country_code') ?? (@$customer->country_code ?? '')}}" 
      class="form-control @error('country_code') is-invalid @enderror" placeholder="Enter Country Code" required>
      @error('country_code')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-6 col-12">
      <label for="phone">Mobile Number</label>
      <input type="text" name="phone" oninput="onlyNumber(this)" value="{{old('phone') ?? (@$customer->phone ?? '')}}" 
      class="form-control @error('phone') is-invalid @enderror" placeholder="Enter Mobile Number" required>
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