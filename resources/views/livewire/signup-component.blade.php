<div class="container">
    <div class="row justify-content-center align-items-center g-2 p-5">
        <div class="col-lg-8">
            <div class="register-photo">
                <div class="form-container">
                    <div class="image-holder"></div>
                    <form method="post" wire:submit.prevent="SignUp">
                        <h2 class="text-center"><strong>Create</strong> an account.</h2>
                        <div class="form-group p-3">
                            <input class="form-control" type="text" name="name" wire:model="name"
                                placeholder="Name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group p-3">
                            <input class="form-control" type="email" name="email" wire:model="email"
                                placeholder="Email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group p-3">
                            <input class="form-control" type="text" name="username" wire:model="username"
                                placeholder="Username">
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group p-3">
                            <input class="form-control" wire:model="password" type="password" name="password"
                                placeholder="Password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group p-3">
                            <input class="form-control" wire:model="confirm_password" type="password"
                                name="password-repeat" placeholder="Password (repeat)">
                            @error('confirm_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col-lg-8 text-center">
                                <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Sign
                                        Up</button></div><a href="{{ route('login') }}" class="already">You already have
                                    an
                                    account?
                                    Login here.</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
