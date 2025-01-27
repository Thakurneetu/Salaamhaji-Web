@if(Session::has('success'))
{{--  Success Messages  --}}
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Success!</strong> {{session('success')}}
</div>
@elseif(Session::has('error'))
{{--  Error Messages  --}}
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Error!</strong> {{session('error')}}
</div>
@elseif($errors->count() > 0)
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Error!</strong> {{$errors->first()}}
</div>
@endif