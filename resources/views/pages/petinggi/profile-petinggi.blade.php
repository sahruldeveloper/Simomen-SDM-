@extends('layouts.petinggi')
 <!-- main  -->
 

 @section('content-petinggi')

 <div class="main-content">
  
    <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8 mt-5">
              <div class="card">
                  <div class="card-header">
                      Update Profile
                  </div>
  
                  <div class="card-body">
                      <form method="POST" action="{{ route('profile-petinggi.update', Auth::guard('petinggi')->user()->id) }}" id="update-profile-petinggi-form">
                          @method('put')
                          @csrf
                        <input type="hidden" name="kategori" value="{{Auth::guard('petinggi')->user()->kategori }}">
                        <input type="hidden" name="id" value="{{Auth::guard('petinggi')->user()->id }}">
                        <input type="hidden" name="npk" value="{{Auth::guard('petinggi')->user()->npk == null ? ' ' : Auth::guard('petinggi')->user()->npk }}">
                          <div class="form-group row">
                              <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
  
                              <div class="col-md-6">
                                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="nama" value="{{ old('name', $user->pegawai == '' ? $user->nama : $user->pegawai->nama) }}" autocomplete="name" autofocus>
                                  <span class="text-danger error-text profile_admin_nama_error" id="profile_petinggi_nama_error"></span>
                                  @error('name')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          
                          <div class="form-group row mt-2">
                              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
  
                              <div class="col-md-6">
                                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" autocomplete="email">
                                  <span class="text-danger error-text profile_admin_email_error" id="profile_petinggi_email_error"></span>
                                  @error('email')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                         
  
                          <div class="form-group row mt-2 mb-2">
                              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
  
                              <div class="col-md-6">
                                 <input type="password" class="form-control" name="password">
                                  <span class="text-danger error-text profile_admin_password_error" id="profile_petinggi_password_error"></span>
                                  @error('password')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
  
                        
  
                        
  
                          <div class="form-group row mb-0">
                              <div class="col-md-6 offset-md-4">
                                  <button type="submit" class="btn btn-primary">
                                      Update Profile
                                  </button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
   
  </div>
 @endsection