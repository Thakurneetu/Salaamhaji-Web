<div class="card-body">
  <div class="row">
    <div class="form-group col-md-6 col-12">
      <label for="area">Area</label>
      <select name="area_id" id="area" class="form-control @error('area_id') is-invalid @enderror" required>
        <option value="" selected disabled>Select Area</option>
        @foreach($areas as $area)
        <option value="{{$area->id}}" {{old('area_id' , @$location->area_id) == $area->id ? 'selected' : ''}}>{{$area->name}}</option>
        @endforeach
      </select>
      @error('area_id')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
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