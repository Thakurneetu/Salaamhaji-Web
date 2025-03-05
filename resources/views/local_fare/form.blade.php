<div class="card-body">
  <div class="row">
    <div class="form-group col-md-6 col-12">
      <label>Location</label>
      <select name="location_id" id="location" class="form-control" required>
        <option value="" selected disabled>Select Location</option>
        @foreach($locations as $_location)
        <option value="{{$_location->id}}" {{old('location_id' , @$location->id) == $_location->id ? 'selected' : ''}}>{{$_location->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-6 col-12"></div>
    <div class="col-md-6 col-12 row">
      @foreach($cabs as $cab)
        <div class="form-group col-12">
          <label>CAB Type: {{$cab->type}}</label>
          <div class="row">
            <div class="form-group col-9">
              <input type="number" step="any" name="prices[{{$cab->id}}]" 
              value="{{old('prices[$cab->id]') ?? (@$location ? @$location->local_fares->where('cab_id', $cab->id)->first()->price : '') }}" 
              class="form-control" placeholder="Enter Fare / Hour">
            </div>
            <div class="form-group col-3">
              <label>Fare / Hour</label>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
  <span class="text-danger">*Leave price empty if cab is not available at this location.</span>
</div>

<div class="card-footer d-flex justify-content-center">
  <button type="submit" class="btn btn-success text_black">Save</button>
  <a href="{{ route('local-fare.index') }}" class="btn btn-secondary ml-3">Cancel</a>
</div>