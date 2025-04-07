@extends('layouts.app')

@section('title')
  Add Customer | 
@endsection

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Add New Customer</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('customer.index')}}">Customer list</a></li>
            <li class="breadcrumb-item active">Add</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  
  <div class="card card-success mx-3">
    <div class="card-header">
      <h3 class="card-title pt-1 text_black"><i class="fas fa-user-plus"></i> Add</h3>
      <a href="{{ route('customer.index') }}" class="btn btn-dark btn-sm float-right">Back</a>
    </div>
    <form action="{{ route('customer.store') }}" method="post">
      @csrf
      @include('customer.form')
    </form>
  </div>
@endsection

@section('script')
<script>
  function onlyAlpha(e) {
    var inputElement = e;
    var inputValue = inputElement.value;
    var sanitizedValue = inputValue.replace(/[^a-zA-Z ]/g, '');
    inputElement.value = sanitizedValue;
  }

  function onlyNumber(e) {
    var inputElement = e;
    var inputValue = inputElement.value;
    var sanitizedValue = inputValue.replace(/[^0-9]/g, '');
    inputElement.value = sanitizedValue;
    if ($(e).attr("name") == 'phone' && inputElement.value.length == 10) {
        validate_phone(inputElement.value);
    }
  }
</script>
@endsection
