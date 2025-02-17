@extends('layouts.app')

@section('title')
Laundry Category | 
@endsection

@section('style')
  @include('layouts.includes.datatablesCss') 
@endsection

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Manage Laundry Category</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Laundry Category</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  
  <div class="container-fluid">  
    <div class="card mb-0">
      <div class="card-header">
        <a href="{{route('laundry_category.create')}}" class="btn btn-warning " style=""><i class="fas fa-user-plus"></i> Add Laundry Category</a>
      </div>
      <div class="card-body">
        {!! $dataTable->table(['class' => 'table table-bordered table-dark table-striped dataTable dtr-inline'], false) !!}
      </div>
    </div>
  </div>    
@endsection

@section('script')
  @include('layouts.includes.datatablesJs') 
  @include('layouts.includes.deleteFunction')
@endsection