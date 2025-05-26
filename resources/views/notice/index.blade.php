@extends('layouts.app')

@section('title')
  Notice Setting |
@endsection

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Mobile Application Notice Setting</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('notice.index')}}">Notice Setting</a></li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  
  <div class="card card-success mx-3">
    <form action="{{ route('notice.store') }}" method="post">
      @csrf
      <div class="card-body">
        <div class="row">
          <div class="form-group col-12">
            <label for="name">CAB Fares Notice</label>
            <textarea class="form-control" name="cab_notice" placeholder="Enter Notice For CAB Fares">{{$cab_notice}}</textarea>
          </div>
          <div class="form-group col-12">
            <label for="name">Food Pricing Notice</label>
            <textarea class="form-control" name="food_notice" placeholder="Enter Notice For Food Pricing">{{$food_notice}}</textarea>
          </div>
        </div>
      </div>
      <div class="card-footer d-flex justify-content-center">
        <button type="submit" class="btn btn-success text_black">Save</button>
      </div>
    </form>
  </div>
@endsection

@section('script')
@endsection
