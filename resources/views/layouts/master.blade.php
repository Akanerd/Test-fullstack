<!DOCTYPE html>
<html lang="en">
@include('components.header')
<body>
    @yield('content')
 
    @include('components.footer')
    @stack('script')
</body>

</html>
