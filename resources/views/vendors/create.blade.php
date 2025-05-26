@extends('layouts.app')

@section('title')
  Add Vendor |
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('plugins/tree-select/style.css') }}">
@endsection

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Add New Vendor</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('vendor-users.index')}}">Vendor list</a></li>
            <li class="breadcrumb-item active">Add</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  
  <div class="card card-success mx-3">
    <div class="card-header">
      <h3 class="card-title pt-1 text_black"><i class="fas fa-user-plus"></i> Add</h3>
      <a href="{{ route('vendor-users.index') }}" class="btn btn-dark btn-sm float-right">Back</a>
    </div>
    <form action="{{ route('vendor-users.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      @include('vendors.form')
    </form>
  </div>
@endsection

@section('script')
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('plugins/tree-select/umd.js') }}"></script>
<script>
  $(document).ready(function () {
    bsCustomFileInput.init();

    const options = [
    {
      name: 'Laundry',
      value: 'Laundry',
    },
    {
      name: 'Food',
      value: 'Food',
    },
    {
      name: 'CAB',
      value: 'CAB',
    },
  ];
  const paidEmployementStatus = new Treeselect({
    parentHtmlContainer: document.querySelector('#services'),
    options: options,
    isSingleSelect: true
  });
  
  paidEmployementStatus.srcElement.addEventListener('input', (e) => {
    // $('#service').val(e.detail.join(','));
    $('#service').val(e.detail);
    toggleFileUpload('Laundry',e.detail);
    toggleFileUpload('Food',e.detail);
    toggleFileUpload('CAB',e.detail);
  })
    
  });

  function toggleFileUpload(key, services){
    // if (services.includes(key)) {
    if(services == key){
      $('#'+key+'-div').show();
      $('#'+key).attr('required', true);
    } else {
      $('#'+key+'-div').hide();
      $('#'+key).removeAttr('required');
    }
  }

  function onlyNumber(e) {
    var inputElement = e;
    var inputValue = inputElement.value;
    var sanitizedValue = inputValue.replace(/[^0-9]/g, '');
    inputElement.value = sanitizedValue;
  }

</script>
@endsection
