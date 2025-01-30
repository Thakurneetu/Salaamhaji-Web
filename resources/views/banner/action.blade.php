<div class="btn-group">
  <a href="{{ route('banner.edit', $id) }}" class='btn btn-sm btn-info tooltip-box'>
    <i class="fa fa-edit"></i>
    <div class="tooltip text-white text-xs -top-full"> 
      <span>Edit</span>
    </div>
  </a>
  <a href="javascript:void(0);" onclick="delete_data({{$id}})" class='btn btn-sm btn-danger tooltip-box'>
    <i class="fa fa-trash"></i></i>
    <div class="tooltip text-white text-xs -top-full">
      <span>Delete</span>
    </div>
  </a>
</div>
<form id="delete_form-{{$id}}" action="{{ route('banner.destroy', $id) }}" method="post">
    @csrf @method('delete')
</form>