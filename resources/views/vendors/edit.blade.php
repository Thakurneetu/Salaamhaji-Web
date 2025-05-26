@extends('layouts.app')

@section('title')
  Edit Vendor |
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('plugins/tree-select/style.css') }}">
@endsection

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Edit Vendor</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('vendor-users.index')}}">Vendor</a></li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  
  <div class="card card-success mx-3">
    <div class="card-header">
      <h3 class="card-title pt-1 text_black"><i class="fa fa-edit"></i> Edit</h3>
      <a href="{{ route('vendor-users.index') }}" class="btn btn-dark btn-sm float-right">Back</a>
    </div>
    <form action="{{ route('vendor-users.update', $vendor->id) }}" method="post" enctype="multipart/form-data">
      @csrf @method('patch')
      @include('vendors.form')
    </form>
  </div>
@endsection
@section('script')
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('plugins/tree-select/umd.js') }}"></script>
<script>
  const lcu = @if($vendor->laundry_catalogue) true @else false @endif ;
  const fcu = @if($vendor->food_catalogue) true @else false @endif ;
  const ccu = @if($vendor->cab_catalogue) true @else false @endif ;
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
    isSingleSelect: true,
    value: "{{$vendor->services}}"
  });
  
  paidEmployementStatus.srcElement.addEventListener('input', (e) => {
    // $('#service').val(e.detail.join(','));
    $('#service').val(e.detail);
    toggleFileUpload('Laundry',e.detail,lcu);
    toggleFileUpload('Food',e.detail,fcu);
    toggleFileUpload('CAB',e.detail,ccu);
  })
    
  });

  function toggleFileUpload(key, services, uploaded){
    if(services == key){
      $('#'+key+'-div').show();
      if(!uploaded){ $('#'+key).attr('required', true); }
    } else {
      $('#'+key+'-div').hide();
      if(!uploaded){ $('#'+key).removeAttr('required'); }
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