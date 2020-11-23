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
  
        @isset($user)
          <form method="POST" action="{{ 'user.dashboard.password.change' }}">
  
            @csrf
  
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="old_password">Old Password</label>
                <input type="password" class="form-control" name="old_password" id="old_password">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="new_password">New Password</label>
                <input type="password" class="form-control" name="new_password" id="new_password">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="new_password">Repeat Password</label>
                <input type="password" class="form-control" name="new_password" id="new_password">
              </div>
            </div>
  
            <button type="submit" class="btn btn-primary">Update Password</button>
            
          </form>
        @endisset
        
      </div>
  
    </div>
  </div>


  




</div>
@endsection
