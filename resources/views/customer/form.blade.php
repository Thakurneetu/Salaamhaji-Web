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
      <label for="phone">Mobile Number</label>
      <input type="text" name="phone" value="{{old('phone') ?? (@$customer->phone ?? '')}}" 
      class="form-control @error('phone') is-invalid @enderror" placeholder="Enter Mobile Number" required>
      @error('phone')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-6 col-12">
      <label>Gender</label>
      <select name="gender" id="gender" class="form-control">
        <option value="" selected disabled>Select Gender</option>
        <option value="Male" {{@$customer->gender == 'Male' ? 'selected' : ''}}>Male</option>
        <option value="Female" {{@$customer->gender == 'Female' ? 'selected' : ''}}>Female</option>
      </select>
    </div>
    <div class="form-group col-md-6 col-12">
      <label for="password">Passsword</label>
      <input type="text" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Password">
      @error('password')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
  </div>
</div>

<div class="card-footer d-flex justify-content-center">
  <button type="submit" class="btn btn-info">Save</button>
  <a href="{{ route('customer.index') }}" class="btn btn-secondary ml-3">Cancel</a>
</div>