<div class="card-body">
  <div class="row">
    <div class="form-group col-md-6 col-12">
      <label for="cab_catalogue">Banner Image</label>
      <div class="input-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="image" name="image" {{@$banner->image != '' ? '' : 'required'}}>
          <label class="custom-file-label" for="cab_catalogue">Select Banner Image</label>
        </div>
      </div>
    </div>
    <div class="form-group col-md-6 col-12">
      <label for="name">Banner Name</label>
      <input type="text" name="name" value="{{old('name') ?? (@$banner->name ?? '')}}"
      class="form-control @error('name') is-invalid @enderror" placeholder="Enter Banner Name">
      @error('name')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    @if(isset($banner) && $banner->image)
      <img style='width:250px' src="{{asset(@$banner->image)}}" alt='banner'>
    @endif
  </div>
</div>

<div class="card-footer d-flex justify-content-center">
  <button type="submit" class="btn btn-success text_black">Save</button>
  <a href="{{ route('banner.index') }}" class="btn btn-secondary ml-3">Cancel</a>
</div>
