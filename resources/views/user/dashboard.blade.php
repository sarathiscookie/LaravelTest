@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row col-md-12">



  <div class="col-md-6">
    <div class="card border-primary">
      <div class="card-header bg-primary"> Profile Details </div>
  
      @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }} <br><br>
        </div>
      @endif
  
      <div class="card-body">
  
        @isset($user)
        <img src="{{ asset('storage/'.$profilePhoto) }}" alt="..." class="img-thumbnail" style="width:25%; height:25%;">
        
          <form method="POST" action="{{ route('user.dashboard.store') }}" enctype="multipart/form-data">
  
            @csrf
  
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="name">Name <span class="required">*</span></label>
                
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $user->name) }}" placeholder="Name" maxlength="255" autocomplete="off">
                
                @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
  
              <div class="form-group col-md-6">
                <label for="address">Address <span class="required">*</span></label>
                
                <input type="text" class="form-control" name="address" id="address" value="{{ ($user->profile) ? $user->profile->address : old('address') }}" placeholder="Address" maxlength="255" autocomplete="off">
                
              </div>
  
            </div>
  
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="photo">Photo</label>
                
                <input type="file" class="form-control-file @error('photo') is-invalid @enderror" name="photo" id="photo">
  
                @error('photo')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
  
            <button type="submit" class="btn btn-primary">Update Profile</button>
            
          </form>
        @endisset
        
      </div>
  
    </div>
  </div>


  <div class="col-md-6">
    <div class="card border-primary">
      <div class="card-header bg-primary"> Password Change </div>
  
      @if (session('passwordStatus'))
        <div class="alert alert-success">
            {{ session('passwordStatus') }} <br><br>
        </div>
      @endif
  
      <div class="card-body">
  
        <form method="POST" action="{{ route('change.password') }}">
          @csrf 

           @foreach ($errors->all() as $error)
              <p class="text-danger">{{ $error }}</p>
           @endforeach 

          <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>

              <div class="col-md-6">
                  <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
              </div>
          </div>

          <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

              <div class="col-md-6">
                  <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
              </div>
          </div>

          <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">New Confirm Password</label>

              <div class="col-md-6">
                  <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
              </div>
          </div>

          <div class="form-group row mb-0">
              <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                      Update Password
                  </button>
              </div>
          </div>
      </form>
        
      </div>
  
    </div>
  </div>


  




</div>
@endsection
