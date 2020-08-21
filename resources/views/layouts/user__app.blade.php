<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


    <style>
        /* these styles will animate bootstrap alerts. */
        .alert {
            z-index: 99;
            top: 60px;
            right: 18px;
            min-width: 30%;
            position: fixed;
            animation: slide 0.5s forwards;
        }

        @keyframes slide {
            100% {
                top: 30px;
            }
        }

        @media screen and (max-width: 668px) {
            .alert {
                /* center the alert on small screens */
                left: 10px;
                right: 10px;
            }
        }
    </style>

    <title>{{config('app.name')}}</title>
</head>

<body>
    {{--  user navbar   --}}
    @include('inc.navbar')
    <main class="container mt-4">
        <div class="container">
            <div class="row ">
                <!-- include left__navbar -->
                @if(Auth::check())
                @include('inc.left__nav')
                @endif

                @yield('content')

                @if(Auth::check())
                @include('inc.right__nav')
                @endif


            </div>
        </div>
    </main>

    <script src="{{asset('js/app.js')}}"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
    <script type="text/javascript">
        // global app configuration object
        var config = {
            routes: "{{ route('user.search_autocomplete') }}"
        };
    </script>
    <script src="{{ url('js/custom.js') }}"></script>
    {{--  Custom Script  --}}
    @yield('scripts')
</body>

</html>
