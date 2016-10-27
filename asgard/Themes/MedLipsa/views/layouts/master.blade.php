<!DOCTYPE html>
<html>
@include('partials.header')
@yield('header')
@section('tag.body')<body>@show

@include('partials.navigation')
@yield('content')
@include('partials.footer')

@yield('scripts')

</body>
</html>
