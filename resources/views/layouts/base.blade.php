<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat system</title>
    {{-- <link rel="stylesheet" href="{{ asset('asset/css/style1.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/icons-1.9.1/font/bootstrap-icons.css') }}">
    <script src="{{ asset('asset/js/jquery.js') }}"></script>
    {{-- <script src="https://www.gstatic.com/firebasejs/9.16.0/firebase-auth.js"></script> --}}
    <style>
        nav svg {
            height: 20px;
        }

        nav .hidden {
            display: block !important;
        }

        a {
            text-decoration: none;
        }
    </style>
    @livewireStyles

</head>

<body>
    @php
        $title = 'Go Shop';
    @endphp
    <nav class="navbar navbar-expand bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">{{ $title }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText" style="margin-left: 50px;">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>

                    @if (!session('user_email'))
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="{{ route('signup') }}">Signup</a>
                        </li>
                    @endif
                </ul>
                <span class="navbar-text">
                    @if (session('user_email'))
                        <div class="dropdown me-5 pe-5">
                            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-bs-toggle='dropdown' aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('storage/user/' . session('user_image')) }}" alt="avatar"
                                    class="rounded-circle" width="30" height="30">
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                @if (session('user_type') == 'AGT')
                                    <a class="dropdown-item" href="{{ route('agent-dashboard') }}">Agent Dashboard</a>
                                @endif
                                @if (session('user_type') == 'ADM')
                                    <a class="dropdown-item" href="{{ route('admin-dashboard') }}">Admin Dashboard</a>
                                @endif
                                <a class="dropdown-item" href="{{ route('user-profile') }}">Profile</a>
                                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                            </div>
                        </div>
                    @endif
                </span>
            </div>
        </div>
    </nav>
    <div style="height: 70%;">

        {{ $slot }}
    </div>
    <div
        class="d-flex flex-column flex-md-row text-center text-md-center justify-content-between py-4 px-4 px-xl-5 bg-dark">
        <!-- Copyright -->
        <div class="text-white mb-3 mb-md-0">
            Copyright © Ahsan Ali. All rights reserved 2023.
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
    @if (session('user_type') == 'USR')
        @livewire('chat-room')
        <div class="chatmessage  arrow-bottom alert bg-light" role="alert">
            <div class="row">
                <div class="col-lg-12 text-black">
                    <span class="fs-5"><strong>Hi there!</strong> &#128512;</span>
                    <button type="button" id="chatmsg" class="close text-danger btn float-end"
                        data-bs-dismiss="alert" aria-label="Close">
                        <span id="btnspan" aria-hidden="true"><i class="bi bi-x-square"></i></span>
                    </button>
                </div>
            </div>
            I see you're intrested in our chat. I would love help you to get started. Do you have any question i am
            achat box?
        </div>
    @endif

    <script src="{{ asset('assets/app.js') }}"></script>
    <script src="{{ asset('assets/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/jquery.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/functions.js') }}"></script>
    @livewireScripts
</body>

</html>
