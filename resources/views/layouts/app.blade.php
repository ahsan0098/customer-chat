<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
    {{ $slot }}
    <script src="{{ asset('assets/app.js') }}"></script>
    <script src="{{ asset('assets/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/jquery.js') }}"></script>
    <script>
        // $(document).on("click", "#chatbtn", function(e) {
        //     $("#btnspan").text('sdf');
        // });
    </script>
    @livewireScripts
</body>

</html>
