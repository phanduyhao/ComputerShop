<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')
</head>
<body>
<div class="layout-site position-relative">
    <!-- header -->
@include('layouts.header')
<!-- main -->
    @yield('content')
    <!-- footer -->
    @include('layouts.footer')
</div>
@include('layouts.foot')
</body>
</html>
