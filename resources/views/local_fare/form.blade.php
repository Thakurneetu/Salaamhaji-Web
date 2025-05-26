<div class="card-body">
  <div class="row">
    <div class="form-group col-md-6 col-12">
      <label for="area">Area</label>
      <select name="area_id" id="area" class="form-control @error('area_id') is-invalid @enderror">
        <option value="" selected disabled>Select Area</option>
        @foreach($areas as $area)
        <option value="{{$area->id}}" {{old('area_id' , @$local_fare->area_id) == $area->id ? 'selected' : ''}}>{{$area->name}}</option>
        @endforeach
      </select>
      @error('area_id')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group col-md-6 col-12">
      <label for="cab_id">Select CAB</label>
      <select name="cab_id" id="cab_id" class="form-control @error('cab_id') is-invalid @enderror" required>
        <option value="" selected disabled>Select CAB</option>
        @foreach($cabs as $_cab)
        <option value="{{$_cab->id}}" {{old('cab_id' , @$local_fare->cab_id) == $_cab->id ? 'selected' : ''}}>{{$_cab->type}}</option>
        @endforeach
      </select>
      @error('cab_id')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group col-md-6 col-12">
      <label for="price">Fare / Hour</label>
      <input type="number" step="any" name="price" value="{{old('price') ?? (@$local_fare->price ?? '')}}"
      class="form-control @error('price') is-invalid @enderror" placeholder="Enter Fare / Hour" required>
      @error('price')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
  </div>
</div>

<div class="card-footer d-flex justify-content-center">
  <button type="submit" class="btn btn-success text_black">Save</button>
  <a href="{{ route('local-fare.index') }}" class="btn btn-secondary ml-3">Cancel</a>
</div>
