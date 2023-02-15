<div class="container">
    <div class="row justify-content-center">
        <div class="card col-lg-10 mt-5">
            <div class="row">
                <div class=" col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">

                        </div>
                        @if (Session::has('message'))
                            <div class="alert alert-success" style="font-size: 18px; font-weight:bold;" role="alert">
                                {{ Session::get('message') }}</div>
                        @endif
                        <div class="panel-body">

                            <form class="form-horizontal" wire:submit.prevent="profile">
                                <div class="form-group my-4">
                                    <div class="">
                                        <input wire:model="name" type="text" class="form-control input-md"
                                            placeholder="Username">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group my-4">
                                    <div class="">
                                        <p class="form-control input-md">{{ session('user_email') }} * <span
                                                class="text-primary">can't be changed</span></p>
                                    </div>

                                </div>
                                <div class="form-group my-4">
                                    <div class="">
                                        <input wire:model="username" name="username" class="form-control input-md"
                                            placeholder="Username" />
                                        @error('username')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group my-4">
                                    <div class="">
                                        <input type="file" wire:model="newimage" id="image"
                                            class="form-control input-md" />
                                        @error('newimage')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        @if ($newimage)
                                            <img src="{{ $newimage->temporaryUrl() }}" alt="" width="50">
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group my-4">
                                    <div class="">
                                        <input type="text" name="address" wire:model="address" id="address"
                                            class="form-control input-md" placeholder="Address" />
                                    </div>
                                </div>

                                <div class="form-group my-4">
                                    <div class="">
                                        <button class="btn btn-primary form-control" type="submit">Update</button>
                                    </div>
                                </div>
                                {{-- </form> --}}

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <img src="{{ asset('storage/user/' . $image) }}" alt="no image" height="100%" width="100%">
                </div>
            </div>
        </div>
    </div>
</div>
