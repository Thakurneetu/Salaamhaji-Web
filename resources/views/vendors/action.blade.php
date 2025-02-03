<div class="btn-group">
  <a href="{{ route('vendor-users.edit', $id) }}" class='btn btn-sm btn-info tooltip-box'>
    <i class="fa fa-edit"></i>
    <div class="tooltip text-white text-xs -top-full"> 
      <span>Edit</span>
    </div>
  </a>
  {{--
  <a href="{{ route('vendor.service', $id) }}" class='btn btn-sm btn-light tooltip-box'>
    <i class="fas fa-cubes"></i>
    <div class="tooltip text-white text-xs -top-full"> 
      <span>Service</span>
    </div>
  </a>
  --}}
  <a href="javascript:void(0);" onclick="delete_data({{$id}})" class='btn btn-sm btn-danger tooltip-box'>
    <i class="fa fa-trash"></i></i>
    <div class="tooltip text-white text-xs -top-full">
      <span>Delete</span>
    </div>
  </a>
</div>
<form id="delete_form-{{$id}}" action="{{ route('vendor-users.destroy', $id) }}" method="post">
    @csrf @method('delete')
</form>