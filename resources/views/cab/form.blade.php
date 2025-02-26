<div class="card-body">
  <div class="row">
    <div class="form-group col-md-6 col-12">
      <label for="type">CAB Type</label>
      <input type="text" name="type" value="{{old('type') ?? (@$cab->type ?? '')}}" 
      class="form-control @error('type') is-invalid @enderror" placeholder="Enter CAB Type">
      @error('type')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-6 col-12">
      <label for="seats">Seats / Passengers</label>
      <input type="text" name="seats" value="{{old('seats') ?? (@$cab->seats ?? '')}}" 
      class="form-control @error('seats') is-invalid @enderror" placeholder="Enter Seats / Passengers">
      @error('seats')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-6 col-12">
      <label for="icon">Icon</label>
      <div class="input-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="icon" name="icon">
          <label class="custom-file-label" for="icon">Select Icon</label>
        </div>
      </div>
    </div>
    @if(isset($cab) && $cab->icon)
      <img style='width:100px' src="{{asset(@$cab->icon)}}" alt='Icon'>
    @endif
  </div>
</div>

<div class="card-footer d-flex justify-content-center">
  <button type="submit" class="btn btn-success text_black">Save</button>
  <a href="{{ route('cab.index') }}" class="btn btn-secondary ml-3">Cancel</a>
</div>