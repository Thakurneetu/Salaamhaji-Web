@extends('layouts.app')

@section('title')
  Edit CAB Type |
@endsection

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Edit CAB Type</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('cab.index')}}">CAB Type</a></li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  
  <div class="card card-success mx-3">
    <div class="card-header">
      <h3 class="card-title pt-1 text_black"><i class="fa fa-edit"></i> Edit</h3>
      <a href="{{ route('cab.index') }}" class="btn btn-dark btn-sm float-right">Back</a>
    </div>
    <form action="{{ route('cab.update', $cab->id) }}" method="post" enctype="multipart/form-data">
      @csrf @method('patch')
      @include('cab.form')
    </form>
  </div>
@endsection

@section('script')
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
  $(document).ready(function () {
    bsCustomFileInput.init();
  });

  function onlyString(e) {
    var inputElement = e;
    var inputValue = inputElement.value;
    var sanitizedValue = inputValue.replace(/[^a-zA-Z0-9,. ]/g, '');
    inputElement.value = sanitizedValue;
  }
</script>
@endsection
