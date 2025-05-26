<div class="btn-group">
  <a href="{{ route('vendor-users.edit', $id) }}" class='btn btn-sm btn-info tooltip-box'>
    <i class="fa fa-edit"></i>
    <div class="tooltip text-white text-xs -top-full">
      <span>Edit</span>
    </div>
  </a>
    @if($services == 'Laundry')
      <a href="{{ route('vendor-laundry-service.index', ['id'=>$id]) }}" class='btn btn-sm btn-primary tooltip-box'>
      <i class="fas fa-tshirt"></i>
    @elseif($services == 'CAB')
      <a href="{{ route('vendor-local-service.index', ['id'=>$id]) }}" class='btn btn-sm btn-primary tooltip-box'>
      <i class="fas fa-taxi"></i>
    @else
      <a href="{{ route('vendor-food-service.index', ['id'=>$id]) }}" class='btn btn-sm btn-primary tooltip-box'>
      <i class="fas fa-pizza-slice"></i>
    @endif
    <div class="tooltip text-white text-xs -top-full">
      <span>Services</span>
    </div>
  </a>
    @if($laundry_catalogue || $cab_catalogue || $food_catalogue)
    @if($services == 'Laundry')
      <a href="{{asset($laundry_catalogue)}}" target="_blank" class='btn btn-sm btn-success tooltip-box'>
    @elseif($services == 'CAB')
      <a href="{{asset($cab_catalogue)}}" target="_blank" class='btn btn-sm btn-success tooltip-box'>
    @else
      <a href="{{asset($food_catalogue)}}" target="_blank" class='btn btn-sm btn-success tooltip-box'>
    @endif
    <i class="nav-icon text_black fas fa-layer-group"></i> 
    <div class="tooltip text-white text-xs -top-full">
      <span>Catalogue</span>
    </div>
  </a>
        @endif
  <button type="button" onclick="delete_data({{$id}})" class='btn btn-sm btn-danger tooltip-box'>
    <i class="fa fa-trash"></i></i>
    <div class="tooltip text-white text-xs -top-full">
      <span>Delete</span>
    </div>
  </button>
</div>
<form id="delete_form-{{$id}}" action="{{ route('vendor-users.destroy', $id) }}" method="post">
    @csrf @method('delete')
</form>