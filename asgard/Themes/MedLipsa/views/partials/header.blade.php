<head lang="ro">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@section('title'){{ 'Medicamente Lipsa' }}@show</title>
@section('meta')
	@section('meta.description')<meta name="description" content="{{ 'Platforma Ministerului Sanatatii pentru anuntarea lipsei unuia sau mai multor medicamente din Romania.' }}" />
@show
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta property="fb:app_id" content="{{ env('FACEBOOK_APP_ID') }}" /> 
	@section('fb.title')<meta property="og:title" content="{{ 'Medicamente Lipsa' }}" />
@show
	@section('fb.type')<meta property="og:type" content="website" />
@show
	@section('fb.image')<meta property="og:image" content="{{ Theme::url('img/share.png') }}" />
@show
	@section('fb.description')<meta property="og:description" content="{{ 'Platforma Ministerului Sanatatii pentru anuntarea lipsei unuia sau mai multor medicamente din Romania.' }}" />
@show
	<meta property="og:url" content="{{ URL::current() }}" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">

	<link rel="apple-touch-icon" sizes="180x180" href="{{ Theme::url('img/apple-touch-icon.png') }}">
	<link rel="icon" type="image/png" href="{{ Theme::url('img/favicon-32x32.png') }}" sizes="32x32">
	<link rel="icon" type="image/png" href="{{ Theme::url('img/favicon-16x16.png') }}" sizes="16x16">
	<link rel="manifest" href="{{ Theme::url('img/manifest.json') }}">
	<link rel="mask-icon" href="{{ Theme::url('img/safari-pinned-tab.svg') }}" color="#5bbad5">
	<link rel="shortcut icon" href="{{ Theme::url('img/favicon.ico') }}">
	<meta name="msapplication-config" content="{{ Theme::url('img/browserconfig.xml') }}">
	<meta name="theme-color" content="#ffffff"> 

    <!-- Bootstrap core CSS -->
    <link href="{{ Theme::url('/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ Theme::url('/css/main.css') }}" rel="stylesheet">

   <link href="https://fonts.googleapis.com/css?family=Press+Start+2P|Roboto:400,700" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700&subset=latin-ext' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin-ext" rel="stylesheet">

    <script src="{{ Theme::url('js/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ Theme::url('js/smoothscroll.js') }}"></script>

</head>
