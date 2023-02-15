<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-12" style="margin-top: 30px;">
            @if (session('message'))
                <div class="alert alert-danger text-danger">{{ session('message') }}</div>
            @endif
            <section class="vh-100">
                <div class="container-fluid h-custom">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-md-9 col-lg-6 col-xl-5">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                                class="img-fluid" alt="Sample image">
                        </div>
                        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                            <form wire:submit.prevent="Login" method="POST">
                                <div
                                    class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                                    <p class="lead fw-normal mb-0 me-3">Sign in with</p>
                                    {{-- <button type="button" class="btn btn-primary btn-floating mx-1">
                                        <i class="bi bi-facebook"></i>
                                    </button>

                                    <button type="button" class="btn btn-primary btn-floating mx-1">
                                        <i class="bi bi-twitter"></i>
                                    </button> --}}

                                    <a href="{{ route('google-login') }}" type="button"
                                        class="btn btn-primary btn-floating mx-1 btn-">
                                        <i class="bi bi-google"> Login with google</i>
                                    </a>
                                </div>

                                <div class="divider d-flex align-items-center my-4">
                                    <p class="text-center fw-bold mx-3 mb-0">Or</p>
                                </div>

                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <input type="email" id="email" name="email" class="form-control"
                                        wire:model="email" placeholder="Enter your email address" />
                                    <label class="form-label" for="form3Example3">Email address</label>
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-3">
                                    <input type="password" id="password" name="password" class="form-control"
                                        wire:model="password" placeholder="Enter password" />
                                    <label class="form-label" for="form3Example4">Password</label>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="text-center text-lg-center mt-4 pt-2">
                                    <button type="submit" class="btn btn-primary btn-lg"
                                        style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                                    <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a
                                            href="{{ route('signup') }}" class="link-danger p-1">Register</a></p>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<div class="d-flex flex-column flex-md-row text-center text-md-center justify-content-between py-4 px-4 px-xl-5 bg-primary"
    style="margin-top: -150px !important;">
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0">
        Copyright © 2020. All rights reserved.
    </div>
    <!-- Copyright -->

    <!-- Right -->
    <div>
        <a href="#!" class="text-white me-4">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="#!" class="text-white me-4">
            <i class="fab fa-twitter"></i>
        </a>
        <a href="#!" class="text-white me-4">
            <i class="fab fa-google"></i>
        </a>
        <a href="#!" class="text-white">
            <i class="fab fa-linkedin-in"></i>
        </a>
    </div>
    <!-- Right -->
</div>
