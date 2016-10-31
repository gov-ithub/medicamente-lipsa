<!DOCTYPE html>
<html>
@include('partials.header')
@yield('header')
@section('tag.body')<body>@show

@include('partials.navigation')
@yield('content')
@include('partials.footer')

{!! Theme::script('js/vendors.js') !!}
{!! Theme::script('js/app.min.js?') !!}
@yield('scripts')
</body>
</html>
