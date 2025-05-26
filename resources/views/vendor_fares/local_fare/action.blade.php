<div class="btn-group">
  <a href="{{ route('vendor-local-service.edit', $id) }}?id={{$vendor_id}}" class='btn btn-sm btn-info tooltip-box'>
    <i class="fa fa-edit"></i>
    <div class="tooltip text-white text-xs -top-full">
      <span>Edit</span>
    </div>
  </a>
  <button type="button" onclick="delete_data({{$id}})" class='btn btn-sm btn-danger tooltip-box'>
    <i class="fa fa-trash"></i></i>
    <div class="tooltip text-white text-xs -top-full">
      <span>Delete</span>
    </div>
  </button>
</div>
<form id="delete_form-{{$id}}" action="{{ route('vendor-local-service.destroy', $id) }}" method="post">
    @csrf @method('delete')
    <input type="hidden" name="vendor_id" value="{{$vendor_id}}">
</form>
