<div class="card-body">
  <div class="row">
    <div class="form-group col-md-6 col-12">
      <label for="cab_id">Select CAB</label>
      <select name="cab_id" id="cab_id" class="form-control" required>
        <option value="" selected disabled>Select CAB</option>
        @foreach($cabs as $_cab)
        <option value="{{$_cab->id}}" {{old('cab_id' , @$cab->id) == $_cab->id ? 'selected' : ''}}>{{$_cab->type}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-md-6 col-12">
      <label for="price">Fare / Hour</label>
      <input type="text" name="price" value="{{old('price') ?? (@$cab->vendor_local_fare->price ?? '')}}"
      class="form-control @error('price') is-invalid @enderror" placeholder="Enter Fare / Hour" required>
    </div>
  </div>
</div>
<input type="hidden" id="vendor_id" name="vendor_id" value="{{$vendor_id}}">
<div class="card-footer d-flex justify-content-center">
  <button type="submit" class="btn btn-success text_black">Save</button>
  <a href="{{ route('vendor-local-service.index') }}?id={{$vendor_id}}" class="btn btn-secondary ml-3">Cancel</a>
</div>