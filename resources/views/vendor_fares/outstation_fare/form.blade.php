<div class="card-body">
  <div class="row">
    <div class="form-group col-md-6 col-12">
      <label for="origin">Origin</label>
      <select name="origin_id" id="origin" class="form-control" required onchange="getDestinations(this.value)">
        <option value="" selected disabled>Select Origin</option>
        @foreach($origins as $_location)
        <option value="{{$_location->id}}" {{old('origin_id' , @$outstation->origin_id) == $_location->id ? 'selected' : ''}}>{{$_location->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-md-6 col-12">
      <label for="destination">Destination</label>
      <select name="destination_id" id="destination" class="form-control" required>
        <option value="" selected disabled>Select Destination</option>
        @foreach($destinations as $_location)
        <option value="{{$_location->id}}" {{old('destination_id' , @$outstation->destination_id) == $_location->id ? 'selected' : ''}}>{{$_location->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-6 col-12 row">
      @foreach($cabs as $cab)
        <div class="form-group col-12">
          <label for="price">CAB Type: {{$cab->type}}</label>
          <div class="row">
            <div class="form-group col-9">
              <input type="number" step="any" name="prices[{{$cab->id}}]" 
              value="{{old('prices[$cab->id]') ?? (@$outstation ? @$outstation->fares->where('cab_id', $cab->id)->first()->price : '') }}" 
              class="form-control" placeholder="Enter Fare">
            </div>
            <div class="form-group col-3">
              <label for="email">Fare</label>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
  <span class="text-danger">*Leave price empty if cab is not available at this location.</span>
</div>
<input type="hidden" id="vendor_id" name="vendor_id" value="{{$vendor_id}}">
<div class="card-footer d-flex justify-content-center">
  <button type="submit" class="btn btn-success text_black">Save</button>
  <a href="{{ route('vendor-outstation-service.index') }}?id={{$vendor_id}}" class="btn btn-secondary ml-3">Cancel</a>
</div>

@push('scripts')
  <script>
    function getDestinations(origin_id){
      let vendor_id = {{$vendor_id}};
      $.ajax({
        method: "GET",
        url: "{{ route('vendor-outstation-service.create') }}?origin_id="+origin_id+"&vendor_id="+vendor_id
      })
      .done(function (res) {
        if(res.success){
          const select = document.getElementById("destination");
          select.innerHTML = '<option value="" selected disabled>Select Destination</option>';
          res.destinations.forEach(destination => {
              const option = document.createElement("option");
              option.value = destination.id;
              option.textContent = destination.name;
              select.appendChild(option);
          });
        }
      })
      .fail(function (err) {
        console.log(err);              
      });
    }
  </script>
@endpush