@extends('layouts.app')

@section('title')
  Add Local Fare | 
@endsection

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Add Vendor Local Fare</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('vendor-local-service.index')}}?id={{$vendor_id}}">Local Fare list</a></li>
            <li class="breadcrumb-item active">Add</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  
  <div class="card card-success mx-3">
    <div class="card-header">
      <h3 class="card-title pt-1 text_black"><i class="fas fa-user-plus"></i> Add</h3>
      <a href="{{ route('vendor-local-service.index') }}?id={{$vendor_id}}" class="btn btn-dark btn-sm float-right">Back</a>
    </div>
    <form action="{{ route('vendor-local-service.store') }}" method="post">
      @csrf
      @include('vendor_fares.local_fare.form')
    </form>
  </div>
@endsection
