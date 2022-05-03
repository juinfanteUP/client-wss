@extends('layout.main-layout')
@section('content')

    <div class="auth-bg">
        <div class="container p-0">
            <div class="row justify-content-center g-0">
                <div class="col-lg-6">
                    <div class="authentication-page-content shadow-lg">
                        <div class="d-flex flex-column h-100 px-4 pt-4">
                            <div class="row justify-content-center">
                                <div class="col-sm-10">

                                    <div class="py-md-5 py-3">

                                        <div class="text-center mb-5">

                                            <div>
                                                <img src="/assets/images/kinect-icon-lg.png" width="128" alt="logo">
                                            </div>
                                            <h3>
                                                Let's Kinect!
                                            </h3>
                                            <p class="text-muted">Connect with anyone, anytime and anywhere using kinect</p>
                                        </div>

                                        <form action="{{route('login')}}" method="post">

                                            <!-- User Id -->
                                            <div class="mb-3">
                                                <label for="tenantId" class="form-label">User Id</label>
                                                <input name="tenant_id" type="text" class="form-control" id="tenantId" placeholder="Enter User id">
                                                <div class="text-danger small">
                                                    @error('tenant_id') {{ $message }} @enderror
                                                </div>
                                            </div>


                                            <!-- Password -->
                                            <div class="mb-3">
                                                <label for="userpassword" class="form-label">
                                                    Password
                                                </label>
                                                <div class="position-relative auth-pass-inputgroup mb-3">
                                                    <input name="password" type="password" class="form-control pe-5" placeholder="Enter Password" id="password-input">
                                                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon">
                                                        <i class="ri-eye-fill align-middle"></i>
                                                    </button>
                                                    <div class="text-danger small">
                                                        @error('password') {{ $message }} @enderror
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- Error Response -->
                                            @if(Session::has('failed'))
                                                <div class="text-center text-danger small">
                                                    {{ Session::get('failed') }}
                                                </div>
                                            @endif

                                            <!-- Success Response -->
                                            @if(Session::has('success'))
                                                <div class="text-center text-success small">
                                                    {{ Session::get('success') }}
                                                </div>
                                            @endif


                                            <!-- Login Button -->
                                            <div class="text-center my-5">
                                                <button class="btn btn-primary w-50" type="submit">Sign In</button>
                                            </div>
                                        </form>

                                        <div class="my-4 text-center">
                                            <div class="signin-other-title">
                                                <p class="fs-14 m-0 title text-muted">New User? Don't have an account?</p>
                                            </div>
                                        </div>

                                        <!-- Go to Register Button -->
                                        <div class=" text-center text-muted">
                                            <p>
                                                <a href="/register" class="fw-medium text-decoration-underline">
                                                    Register Account
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Footer -->
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="text-center text-muted p-4">
                                        <p class="mb-0">&copy;
                                            <script>document.write(new Date().getFullYear())</script> 
                                            Developed by Dave Infante <small>(CMSC207)</small>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection