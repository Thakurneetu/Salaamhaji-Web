@extends('layouts.app')

@section('title')
  Edit Food Menu | 
@endsection

@section('style')
<link href="{{ asset('plugins/date-time-picker/bootstrap-material-datetimepicker.min.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Edit Food Menu</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('food-menu.index')}}">Food Menu</a></li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  
  <div class="card card-success mx-3">
    <div class="card-header">
      <h3 class="card-title pt-1 text_black"><i class="fa fa-edit"></i> Edit</h3>
      <a href="{{ route('food-menu.index') }}" class="btn btn-dark btn-sm float-right">Back</a>
    </div>
    <form action="{{ route('food-menu.update', $foodMenu->id) }}" method="post" enctype="multipart/form-data">
      @csrf @method('patch')
      @include('food_menu.form')
    </form>
  </div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.min.js" defer></script>
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