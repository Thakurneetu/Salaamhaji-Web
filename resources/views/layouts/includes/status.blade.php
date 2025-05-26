<div class="form-group">
  <div class="custom-control custom-switch">
    <input type="checkbox" name="activeSwitch" value="{{$status}}" {{$status == 1 ? "checked" : ""}}
          class="custom-control-input" data-id="{{$id}}" 
          data-route="{{url()->current()}}" onchange="change_status(this, {{$id}})"
          id="customSwitch-{{$id}}" aria-label="Toggle active status">
    <label class="custom-control-label" for="customSwitch-{{$id}}"></label>
  </div>
</div>