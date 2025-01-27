<div class="card-body">
  <div class="row">
    <!-- Name -->
    <div class="form-group col-md-6 col-12">
      <label for="name">Name</label>
      <input type="text" name="name" value="{{old('name') ?? (@$vendor->name ?? '')}}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Vendor Name">
      @error('name')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
  </div>
</div>

<div class="card-footer d-flex justify-content-center">
  <button type="submit" class="btn btn-info">Save</button>
  <a href="{{ route('vendor-users.index') }}" class="btn btn-secondary ml-3">Cancel</a>
</div>