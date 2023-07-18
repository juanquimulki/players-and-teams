<!DOCTYPE html>
<html>
    <head>
        <title>Players & Teams - @yield('title')</title>

        <style>
            .content {
                margin: 50px 40px 30px 40px;
            }
        </style>
    </head>
    <body>
        <div class="content">
            @yield('content')
        </div>
    </body>
</html>
<script src="{{ mix('/js/app.js') }}"></script>