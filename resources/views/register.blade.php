@extends('layout.main-layout')
@section('content')

    <div class="auth-bg">
        <div class="container p-0">
            <div class="row justify-content-center g-0">
                <div class="col-sm-12 col-md-10 col-xl-7">
                    <div class="authentication-page-content shadow-lg">
                        <div class="d-flex flex-column h-100 px-4 pt-4">
                            <div class="row justify-content-center my-auto">
                                <div class="col-sm-10">
                                    <div class="py-md-4 py-2">

                                        <!-- Header -->
                                        <div class="text-center mb-5">
                                            <h3>Register Account</h3>
                                            <p class="text-muted">Fill up the required fields to register your new account</p>
                                        </div>

                                        <form action="{{route('register')}}" method="post">

                                            <!-- User Id -->
                                            <div class="mb-3">
                                                <label for="useremail" class="form-label">User Id</label>
                                                <input name="tenant_id" value="{{ old('tenant_id') }}" type="number" class="form-control" placeholder="Enter User Id (4 digits)">
                                                <div class="text-danger small">
                                                    @error('tenant_id') {{ $message }} @enderror
                                                </div>
                                            </div>

                                            <!-- Email -->
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Email</label>
                                                <input name="email" value="{{ old('email') }}" type="text" class="form-control" placeholder="Enter email">
                                                <div class="text-danger small">
                                                    @error('email') {{ $message }} @enderror
                                                </div>
                                            </div>

                                            <!-- Name -->
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Name</label>
                                                <input name="name" value="{{ old('name') }}" type="text" class="form-control" placeholder="Enter full name">
                                                    <div class="text-danger small">
                                                        @error('name') {{ $message }} @enderror
                                                    </div>
                                            </div>

                                            <!-- Contact Number -->
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Contact No</label>
                                                <input name="contact_no" value="{{ old('contact_no') }}" type="text" class="form-control" placeholder="Enter contact number">
                                                <div class="text-danger small">
                                                    @error('contact_no') {{ $message }} @enderror
                                                </div>
                                            </div>

                                            <!-- Password -->
                                            <div class="mb-3">
                                                <label for="userpassword" class="form-label">Password</label>
                                                <input name="password" type="password" class="form-control" placeholder="Enter password">
                                                <div class="text-danger small">
                                                    @error('password') {{ $message }} @enderror
                                                </div>
                                            </div>

                                            <!-- Confirm Password -->
                                            <div class="mb-4">
                                                <label for="userpassword" class="form-label">Password</label>
                                                <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm password">
                                                <div class="text-danger small">
                                                    @error('password_confirmation') {{ $message }} @enderror
                                                </div>
                                            </div>


                                            <!-- Error Response -->
                                            @if(Session::has('failed'))
                                                <div class="text=-center text-danger small">
                                                    {{ Session::get('failed') }}
                                                </div>
                                            @endif


                                            <!-- Register Button -->
                                            <div class="text-center mt-5 mb-3">
                                                <button class="btn btn-primary w-50 waves-effect waves-light" onclick="confirmRegister()" type="submit">
                                                    Register
                                                </button>
                                            </div>
                                        </form>

                                        
                                        <div class="my-4 text-center">
                                            <div class="signin-other-title">
                                                <p class="fs-14 m-0 title text-muted"></p>
                                            </div>
                                        </div>


                                        <!-- Go to Login Button -->
                                        <div class="mt-3 text-center text-muted">
                                            <p>
                                                Already have an account ? 
                                                <a href="/login" class="fw-medium text-decoration-underline">Login</a>
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
    </div>


    <script>
        function confirmRegister(){
            if(confirm('Are you sure you want to register a new user?')){
                return true;
            }
            return false;
        }
    </script>
@endsection