@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
  <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
              <ul class="nav flex-column">
                  <li class="nav-item">
                      <a class="nav-link active" href="/admin/dashboard">
                          <i class="fas fa-home"></i>
                          User List <span class="sr-only">(current)</span>
                      </a>
                  </li>

              </ul>
          </div>
      </nav>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

        <div class="card border-primary">
          <div class="card-header bg-primary"> User Details </div>
  
          @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }} <br><br>
            </div>
          @endif
  
          <div class="card-body table-responsive">
            <table class="table table-bordered table-hover table-stripped">
              <thead>
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Username</th>
                  <th scope="col">Email</th>
                  <th scope="col">Type</th>
                  <th scope="col">Address</th>
                  <th scope="col">Photo</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($users as $user)
                @php
                    $result = '';

                    $noData = '<span class="badge badge-secondary">No Data</span>';

                    $address = ($user->profile) ? $user->profile->address : $noData;

                    if ($user->profile && $user->profile->photo) {
                       $explodePublic = explode('public', $user->profile->photo);

                       $profilePhoto = $explodePublic[1];
                    }    
                    else {
                        $profilePhoto = 'nopreview.png';
                    }

                    $userType = ($user->user_type === 0) ? '<span class="badge badge-primary">Admin</span>' : '<span class="badge badge-primary">User</span>';

                @endphp
                <tr>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->username }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{!! $userType !!}</td>
                  <td>{!! $address !!}</td>
                  <td><img src="{{ asset('storage/'.$profilePhoto) }}" alt="Profile Photo" class="img-thumbnail" style="width:25%; height:25%;"></td>
                  <td>
                    <select class="form-control changeStatus" data-id="{{ $user->id }}">
                      @foreach ($userStatus as $key => $value)
                          <option value="{{ $key }}" @if($user->status == $key) selected @endif>{{ $value }}</option>
                      @endforeach
                    </select>
                  </td>
                </tr>
                @empty
                    <p>No users</p>
                @endforelse
              </tbody>
            </table>
          </div>
  
        </div>

      </main>

  </div>
</div>
@endsection
