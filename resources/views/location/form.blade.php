<div class="card-body">
  <div class="row">
    <div class="form-group col-md-6 col-12">
      <label for="name">Location Name</label>
      <input type="text" name="name" value="{{old('name') ?? (@$location->name ?? '')}}" 
      class="form-control @error('name') is-invalid @enderror" placeholder="Enter Location Name" required>
      @error('name')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
  </div>
</div>

<div class="card-footer d-flex justify-content-center">
  <button type="submit" class="btn btn-success text_black">Save</button>
  <a href="{{ route('location.index') }}" class="btn btn-secondary ml-3">Cancel</a>
</div>