@extends('layouts.app')

{{--  Title  --}}
@section('title') My Profile @endsection

{{--  Section  --}}
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ isset(Auth::user()->image) && Auth::user()->image ? Auth::user()->image : asset('image/user.png') }}" alt="User">
                            </div>
                            <h3 class="profile-username text-center">{{$profile->name}}</h3>

                            <p class="text-muted text-center">({{$profile->roles->first()->name ?? ''}})</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item text-center">
                                    <b>Registered At</b><br> <a class="">{{$profile->created_at->format('d F, Y')}}</a>
                                </li>
                            </ul>

                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

                {{--  Profile Forms  --}}
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link {{(isset($activeTab) && ($activeTab == 'profile')) ? 'active' : ''}}" href="#profile-data"
                                        data-toggle="tab">Profile</a></li>
                                <li class="nav-item"><a class="nav-link {{(isset($activeTab) && ($activeTab == 'change-password')) ? 'active' : ''}}" href="#change-password" data-toggle="tab">Change Password</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                {{--  Profile Data  --}}
                                <div class="tab-pane {{(isset($activeTab) && ($activeTab == 'profile')) ? 'active' : ''}}" id="profile-data">                                    
                                  {!! Form::model($profile, ['route' => 'profile.update']) !!}
                                    {!! Form::hidden('id',null,) !!}
                                    <div class="form-group row">
                                      <label for="firstName" class="col-sm-2 col-form-label">Name</label>
                                      <div class="col-sm-10">
                                      @error('name')
                                      {!! Form::text('name', null,  ['class' => 'form-control is-invalid','id' => 'name','placeholder'=>'Enter Name']) !!}
                                      <div class="text-danger">{{ $message }}</div>
                                      @else
                                      {!! Form::text('name', null,  ['class' => 'form-control','id' => 'name','placeholder'=>'Enter Name']) !!}
                                      @enderror
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="Email" class="col-sm-2 col-form-label">Email</label>
                                      <div class="col-sm-10">
                                      @error('email')
                                      {!! Form::email('email', null,  ['class' => 'form-control is-invalid','id' => 'email' ,'placeholder'=>'Enter email']) !!}
                                      <div class="text-danger">{{ $message }}</div>
                                      @else
                                      {!! Form::email('email', null,  ['class' => 'form-control','id' => 'email' ,'placeholder'=>'Enter email']) !!}
                                      @enderror
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="Mobile" class="col-sm-2 col-form-label">Mobile</label>
                                      <div class="col-sm-10">
                                      @error('phone')
                                      {!! Form::number('phone', null,  ['class' => 'form-control is-invalid','id' => 'phone' ,'placeholder'=>'Enter mobile no.']) !!}
                                      <div class="text-danger">{{ $message }}</div>
                                      @else
                                      {!! Form::number('phone', null,  ['class' => 'form-control','id' => 'phone' ,'placeholder'=>'Enter mobile no.']) !!}
                                      @enderror
                                      </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                      <div class="offset-sm-9 col-sm-3 pull-right">
                                        <button type="submit" class="btn btn-success">Update Profile</button>
                                      </div>
                                    </div>                                    
                                  {!! Form::close() !!}
                                </div>
                                {{--  Change Password  --}}
                                <div class="tab-pane {{(isset($activeTab) && ($activeTab == 'change-password')) ? 'active' : ''}}" id="change-password">
                                  {!! Form::open(['route' => 'profile.password.update']) !!}
                                    <input type="hidden" name="id" value="{{$profile->id}}" />
                                    <div class="form-group row">
                                      <label for="oldPassword" class="col-sm-2 col-form-label">Current Password</label>
                                      <div class="col-sm-10">
                                        @error('current_password')
                                        {!! Form::password('current_password', ['class' => 'form-control is-invalid','id' => 'password','placeholder'=>'Enter Old Password', 'autocomplete'=>'new-password']) !!}
                                        <div class="text-danger">{{ $message }}</div>
                                        @else
                                        {!! Form::password('current_password', ['class' => 'form-control','id' => 'password','placeholder'=>'Enter Old Password', 'autocomplete'=>'new-password']) !!}
                                        @enderror
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="newPassword" class="col-sm-2 col-form-label">New Password</label>
                                      <div class="col-sm-10">
                                        @error('new_password')
                                        {!! Form::password('new_password', ['class' => 'form-control is-invalid','id' => 'newPassword','placeholder'=>'Enter New Password', 'autocomplete'=>'new-password']) !!}
                                        <div class="text-danger">{{ $message }}</div>
                                        @else
                                        {!! Form::password('new_password', ['class' => 'form-control','id' => 'newPassword','placeholder'=>'Enter New Password', 'autocomplete'=>'new-password']) !!}
                                        @enderror
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="confirmNewPassword" class="col-sm-2 col-form-label">Confirm New Password</label>
                                      <div class="col-sm-10">
                                        @error('new_confirm_password')
                                        {!! Form::password('new_confirm_password', ['class' => 'form-control is-invalid','id' => 'new_confirm_password','placeholder'=>'Confirm New Password', 'autocomplete'=>'new-password']) !!}
                                        <div class="text-danger">{{ $message }}</div>
                                        @else
                                        {!! Form::password('new_confirm_password', ['class' => 'form-control','id' => 'new_confirm_password','placeholder'=>'Confirm New Password', 'autocomplete'=>'new-password']) !!}
                                        @enderror
                                      </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                      <div class="offset-sm-9 col-sm-3">
                                        <button type="submit" class="btn btn-success">Change Password</button>
                                      </div>
                                    </div>
                                  {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</div>
@endsection

{{--  Scripts  --}}
@section('scripts')

@endsection
