@extends('client.layouts.authen')

@section('content')

<div class="row h-100">
    <div class="col-xxl-7">
         <div class="row justify-content-center h-100">
              <div class="col-lg-6 py-lg-5">
                   <div class="d-flex flex-column h-100 justify-content-center">
                        <div class="auth-logo mb-4">
                             <a href="index.html" class="logo-dark">
                                  <img src="{{ asset('theme/admin/assets/images/logo-dark.png') }}" height="24" alt="logo dark">
                             </a>

                             <a href="index.html" class="logo-light">
                                  <img src="{{ asset('theme/admin/assets/images/logo-light.png') }}" height="24" alt="logo light">
                             </a>
                        </div>

                        <h2 class="fw-bold fs-24">Sign In</h2>

                        @if (session('success'))
                            <span class="alert alert-success">{{ session('success') }}</span>
                        @endif
                        @if (session('error'))
                            <span class="alert alert-danger">{{ session('error') }}</span>
                        @endif

                        <div class="mb-5">
                             <form action="{{ route('auth.login') }}" method="POST" class="authentication-form">
                                @csrf  
                                <div class="mb-3">
                                       <label class="form-label" for="example-email">Email</label>
                                       <input type="text" id="example-email" name="email" class="form-control bg-" value="{{ old('email') }}" placeholder="Enter your email">
                                       @error('email')
                                             <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                  </div>
                                  <div class="mb-3">
                                       <a href="auth-password.html" class="float-end text-muted text-unline-dashed ms-1">Reset password</a>
                                       <label class="form-label" for="example-password">Password</label>
                                       <input type="password" id="example-password" name="password" class="form-control" placeholder="Enter your password">
                                  </div>
                                  <div class="mb-3">
                                        <div class="form-check">
                                             <input type="checkbox" name="remember" class="form-check-input" id="checkbox-signin" 
                                                  {{ old('remember') ? 'checked' : '' }}>
                                             <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                        </div>
                                  </div>

                                  <div class="mb-1 text-center d-grid">
                                       <button class="btn btn-soft-primary" type="submit">Đăng nhập</button>
                                  </div>
                             </form>

                             <p class="mt-3 fw-semibold no-span">OR sign with</p>

                             <div class="d-grid gap-2">
                                  <a href="javascript:void(0);" class="btn btn-soft-dark"><i class="bx bxl-google fs-20 me-1"></i> Sign in with Google</a>
                                  <a href="javascript:void(0);" class="btn btn-soft-primary"><i class="bx bxl-facebook fs-20 me-1"></i> Sign in with Facebook</a>
                             </div>
                        </div>

                        <p class="text-danger text-center">Don't have an account? <a href="{{ route('auth.register') }}" class="text-dark fw-bold ms-1">Sign Up</a></p>
                   </div>
              </div>
         </div>
    </div>

    <div class="col-xxl-5 d-none d-xxl-flex">
         <div class="card h-100 mb-0 overflow-hidden">
              <div class="d-flex flex-column h-100">
                   <img src="{{ asset('theme/admin/assets/images/small/img-10.jpg') }}" alt="" class="w-100 h-100">
              </div>
         </div>
    </div>
</div>

@endsection