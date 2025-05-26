@extends('layouts.app')

@section('title')
  Order Details |
@endsection

@section('style')
<link href="{{ asset('plugins/date-time-picker/bootstrap-material-datetimepicker.min.css') }}" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Order Details</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('order.index')}}">Order</a></li>
            <li class="breadcrumb-item active">Details</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  
  <div class="card card-success mx-3">
    <div class="card-header">
      <h3 class="card-title pt-1 text_black"><i class="fa fa-edit"></i> Details</h3>
      <a href="{{ route('order.index') }}{{request()->type == 'food' ? '?type=food' : (request()->type == 'cab' ? '?type=cab' : '')}}" class="btn btn-dark btn-sm float-right">Back</a>
    </div>
    <div class="card-body">
        @include('order.customer_detail')
        @include('order.order_detail')
        @if($order->type == 'food')
          @include('order.food_items')
          @include('order.food_menu')
        @elseif($order->type == 'laundry')
          @include('order.laundry_items')
        @elseif($order->type == 'cab')
          @include('order.cab_order')
        @endif
        @include('order.vendor_detail')
    </div>
  </div>
@endsection

@push('scripts')
<script>
  function changeStatus(id, status, type){
    $.ajax({
      method: "POST",
      url: "{{ route('order.update', $order->id) }}",
      data: {_token: "{{csrf_token()}}", _method:'PUT', order_id:id, status: status, type:type},
    })
    .done(function (res) {
      if(res.success){
        Swal.fire({
        title: res.message,
        icon: "success",
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
      });
      }
    })
    .fail(function (err) {
      console.log(err);
    });
  }
</script>
@endpush

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"
 integrity="sha512-hUhvpC5f8cgc04OZb55j0KNGh4eh7dLxd/dPSJ5VyzqDWxsayYbojWyl5Tkcgrmb/RVKCRJI1jNlRbVP4WWC4w=="
  crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.min.js"
 integrity="sha512-LRkOtikKE2LFHPWiWh0/bfFynswxRwCZ5O7PkXTVFPcprw376xfOemiEHEOmCCmiwS6eLFUh2fb+Gqxc0waTSg=="
 crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
<script>
  $(document).ready(function () {
    $('.timepicker').bootstrapMaterialDatePicker({
      date: true,
      shortTime: true,
      format: 'YYYY-MM-DD HH:mm',
      switchOnClick: true,
      clearButton: false,
    });
  });
</script>
@endsection
