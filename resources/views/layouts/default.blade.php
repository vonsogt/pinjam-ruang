<!DOCTYPE html>
<html lang="en">
    <head>
        @include('includes.head')
    </head>
    <body>
        @include('includes.header')

        @yield('content')

        @include('includes.footer')
        @yield('scripts')
    </body>
</html>
