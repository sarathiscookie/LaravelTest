@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
  <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
              <ul class="nav flex-column">
                  <li class="nav-item">
                      <a class="nav-link active" href="/user/dashboard">
                          <i class="fas fa-home"></i>
                          Profile <span class="sr-only">(current)</span>
                      </a>

                      {{-- <a class="nav-link active" href="/user/change/password">
                        <i class="fas fa-home"></i>
                        Change Password <span class="sr-only">(current)</span>
                      </a> --}}
                  </li>

              </ul>
          </div>
      </nav>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

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

      </main>

  </div>
</div>
@endsection
