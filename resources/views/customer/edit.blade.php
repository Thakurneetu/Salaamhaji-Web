@extends('layouts.app')

@section('title')
  Edit Customer | 
@endsection

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/25.3.1/build/css/intlTelInput.min.css" 
integrity="sha512-X3pJz9m4oT4uHCYS6UjxVdWk1yxSJJIJOJMIkf7TjPpb1BzugjiFyHu7WsXQvMMMZTnGUA9Q/GyxxCWNDZpdHA==" crossorigin="anonymous" 
referrerpolicy="no-referrer" />
<style>
  @media (prefers-color-scheme: dark) {
  .iti {
    width: 100%;
    --iti-border-color: #5b5b5b;
    --iti-dialcode-color: #999999;
    --iti-dropdown-bg: #0d1117;
    --iti-arrow-color: #aaaaaa;
    --iti-hover-color: #30363d;
    --iti-path-globe-1x: url("https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/img/globe_light.webp");
    --iti-path-globe-2x: url("https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/img/globe_light@2x.webp");
  }
}
</style>
@endsection

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Edit Customer</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('customer.index')}}">Customer</a></li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  
  <div class="card card-success mx-3">
    <div class="card-header">
      <h3 class="card-title pt-1 text_black"><i class="fa fa-edit"></i> Edit</h3>
      <a href="{{ route('customer.index') }}" class="btn btn-dark btn-sm float-right">Back</a>
    </div>
    <form action="{{ route('customer.update', $customer->id) }}" method="post">
      @csrf @method('patch')
      @include('customer.form')
    </form>
  </div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/25.3.1/build/js/intlTelInput.min.js" 
        integrity="sha512-SlsU65KdLej2skQ24jI+POL40KCeJ7aR9dy6lhT6ZUggKQeoqq6Lj+7n6i8zqO2gcelYQBPgOdrtIwDXF6cLIw==" 
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  var input = document.querySelector("#phone");
  var iti = window.intlTelInput(input, {
      separateDialCode: true,
      utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js",
  });
  input.addEventListener("countrychange", () => {
    let number = iti.getSelectedCountryData();
    console.log(number);
    $('#code').val('+'+number.dialCode);
  });
  function onlyAlpha(e) {
    var inputElement = e;
    var inputValue = inputElement.value;
    var sanitizedValue = inputValue.replace(/[^a-zA-Z ]/g, '');
    inputElement.value = sanitizedValue;
  }

  function onlyNumber(e) {
    var inputElement = e;
    var inputValue = inputElement.value;
    var sanitizedValue = inputValue.replace(/[^0-9]/g, '');
    inputElement.value = sanitizedValue;
  }
</script>
@endsection
