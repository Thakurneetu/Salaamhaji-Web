@extends('layouts.app')

@section('title')
  Edit Local Fare | 
@endsection

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Edit Vendor Local Fare</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('vendor-local-service.index')}}?id={{$vendor_id}}">Local Fare List</a></li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  
  <div class="card card-success mx-3">
    <div class="card-header">
      <h3 class="card-title pt-1 text_black"><i class="fa fa-edit"></i> Edit</h3>
      <a href="{{ route('vendor-local-service.index') }}?id={{$vendor_id}}" class="btn btn-dark btn-sm float-right">Back</a>
    </div>
    <form action="{{ route('vendor-local-service.update', $cab->id) }}" method="post">
      @csrf @method('patch')
      @include('vendor_fares.local_fare.form')
    </form>
  </div>
@endsection
