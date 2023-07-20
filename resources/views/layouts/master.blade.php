<!DOCTYPE html>
<html>
    <head>
        <title>Players & Teams - @yield('title')</title>
        <link rel="icon" href="{{ asset('favicon.png') }}">

        <style>
            .content {
                margin: 50px 40px 30px 40px;
            }
        </style>
    </head>
    <body>
        <div id="app" class="container">
            <navbar-component></navbar-component>
            <div class="content">
                @yield('content')
            </div>
        </div>
    </body>
</html>
<script src="{{ mix('/js/app.js') }}"></script>
