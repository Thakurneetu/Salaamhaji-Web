@extends('layouts.app')

@section('title')
  Edit Food Item |
@endsection

@section('style')
<link href="{{ asset('plugins/date-time-picker/bootstrap-material-datetimepicker.min.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Edit Food Item</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('vendor-food-service.index')}}">Food Item</a></li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  
  <div class="card card-success mx-3">
    <div class="card-header">
      <h3 class="card-title pt-1 text_black"><i class="fa fa-edit"></i> Edit</h3>
      <a href="{{ route('vendor-food-service.index') }}" class="btn btn-dark btn-sm float-right">Back</a>
    </div>
    <form action="{{ route('vendor-food-service.update', $vendorFoodService->id) }}" method="post">
      @csrf @method('patch')
      @include('vendor_food_service.form')
    </form>
  </div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"
 integrity="sha512-hUhvpC5f8cgc04OZb55j0KNGh4eh7dLxd/dPSJ5VyzqDWxsayYbojWyl5Tkcgrmb/RVKCRJI1jNlRbVP4WWC4w=="
  crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.min.js"
 integrity="sha512-LRkOtikKE2LFHPWiWh0/bfFynswxRwCZ5O7PkXTVFPcprw376xfOemiEHEOmCCmiwS6eLFUh2fb+Gqxc0waTSg=="
 crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
<script>
<script>
  $(document).ready(function () {
    $('.timepicker').bootstrapMaterialDatePicker({
      date: false,
      shortTime: true,
      format: 'HH:mm',
      switchOnClick: true,
      clearButton: false,
    });
  });
</script>
@endsection
