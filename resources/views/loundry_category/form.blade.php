<div class="card-body">
  <div class="row">
    <div class="form-group col-md-6 col-12">
      <label for="name">Name</label>
      <input type="text" name="name" value="{{old('name') ?? (@$loundryCategory->name ?? '')}}" 
      class="form-control @error('name') is-invalid @enderror" placeholder="Enter Category Name" required>
      @error('name')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
  </div>
</div>

<div class="card-footer d-flex justify-content-center">
  <button type="submit" class="btn btn-success text_black">Save</button>
  <a href="{{ route('loundry_category.index') }}" class="btn btn-secondary ml-3">Cancel</a>
</div>