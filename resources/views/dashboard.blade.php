@extends('layouts.app')

{{--  Title  --}}
@section('title')
 Dashboard 
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Monthly Recap Report</h5>
            <div class="card-tools">
              <div class="btn-group">
                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                  <i class="fas fa-wrench"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" id="demolist" role="menu">
                  <a href="#" class="dropdown-item">Today</a>
                  <a href="#" class="dropdown-item">Weekly</a>
                  <a href="#" class="dropdown-item">Monthly</a>
                  <a href="#" class="dropdown-item">Yearly</a>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->

          <div class="card-body">
            
          <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box bg-secondary">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Customers</span>
                  <span class="info-box-number" id="customer_count">{{$customer_count}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3 bg-secondary">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Vendors</span>
                  <span class="info-box-number" id="vendor_count">{{$vendor_count}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="clearfix hidden-md-up"></div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3 bg-secondary">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-bag"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Total Orders</span>
                  <span class="info-box-number" id="order_count">{{$order_count}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3 bg-secondary">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-cart"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Pending Orders</span>
                  <span class="info-box-number" id="pending_order_count">{{$pending_order_count}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
          </div>

          </div>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <div class="row">
      <!-- Left col -->
      <div class="col-md-12">

        <!-- TABLE: LATEST ORDERS -->
        <div class="card">
          <div class="card-header border-transparent">
            <h3 class="card-title">Latest Orders</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Order Type</th>
                  <th>Customer name</th>
                  <th>Amount</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody id="orders">
                  @if($orders)
                    @foreach($orders as $item)
                    <tr>
                      <td><a href="order/{{$item->id}}?type={{$item->type}}">{{$item->uuid}}</a></td>
                      <td>{{$item->type}}</td>
                      <td>{{$item->customer_name}}</td>
                      <td>{{$item->grand_total}}</td>
                      <td>
                        @if($item->status=='Active')
                        <span class="badge badge-danger">{{$item->status}}</span>
                        @elseif($item->status=='Out for delivery')
                        <span class="badge badge-warning">{{$item->status}}</span>
                        @elseif($item->status=='Confirmed')
                        <span class="badge badge-success">{{$item->status}}</span>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  @else
                  <tr>
                      <td colspan="4">No Orders Found</td>
                  </tr>
                  @endif
               
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
          <!-- /.card-footer -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</section>
<!--<div class="loader"></div>-->
<a class="back-to-top inner-link" href="#start" data-scroll-class="100vh:active">
  <i class="stack-interface stack-up-open-big"></i>
</a>
@endsection

@section('script')
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<script>
  $(function () {
    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July','August', 'September', 'October', 'November','December'],
      datasets: [
        {
          label               : 'Item',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90, 28, 48, 40, 19, 86]
        }
      ]
    }
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    barChartData.datasets[0] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })
  })
</script>

<!-- <link rel="stylesheet" href="{{asset('css/helper.css')}}">
<link rel="stylesheet" href="{{asset('css/sweetalert.css')}}">
<link rel="stylesheet" href="{{asset('css/jquery.toast.css')}}">
<script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('js/smooth-scroll.min.js')}}"></script>
<script src="{{asset('js/helper.js')}}"></script>
<script src="{{asset('js/jquery.toast.js')}}"></script>
<script src="{{asset('js/sweetalert.min.js')}}"></script> -->
<script>
  

  $('#demolist a ').click(function () { 
            // alert('hi');  
    $.ajax({
      url: "{{ route('home') }}",
      //container: '#dashbordForm',
      //type: "POST",
      //redirect: true,
      data: {val:$(this).text(),action:'filter'},
      success: function(response) {
        console.log(response);

        $('#customer_count').html(response.customer_count);
        $('#order_count').html(response.order_count);
        $('#pending_order_count').html(response.pending_order_count);
        $('#vendor_count').html(response.vendor_count);
        $('#orders').html(response.orders);
        //if (response.status) {
          
         // swal("Sent!", response.message, "success");
          // setInterval(function () {
          //   window.location.reload();
          // }, 4000);
       // }
      }                    
    })
  });
</script>
@endsection