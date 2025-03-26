@extends('layouts.app')

@section('title')
Outstation Fare | 
@endsection

@section('style')
  @include('layouts.includes.datatablesCss') 
@endsection

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Manage Vendor Outstation Fare</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Outstation Fare</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  
  <div class="container-fluid">  
    <div class="card mb-0">
      <div class="card-header">
        <a href="{{route('vendor-local-service.index')}}?id={{$vendor_id}}" class="btn btn-light" style=""><i class="fas fa-map-marker-alt"></i> Local Fares</a>
        <a href="#" class="btn btn-dark" style=""><i class="fas fa-route"></i> Outstaion Fares</a>
        <a href="{{route('vendor-outstation-service.create')}}?id={{$vendor_id}}" class="btn btn-warning float-right" style=""><i class="fas fa-user-plus"></i> Add Outstation Fare</a>
      </div>
      <div class="card-body">
        {!! $dataTable->table(['class' => 'table table-bordered table-dark dataTable dtr-inline'], false) !!}
      </div>
    </div>
  </div>    
@endsection

@section('script')
  @include('layouts.includes.datatablesJs') 
  @include('layouts.includes.deleteFunction')
@endsection