<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PHP Challenge</title>
    <link href="{{asset('/css/app.css')}}" rel="stylesheet" type="text/css">
</head>
<body class="bg-info text-white">
<div id="app">
    @include('header')
    @yield('content')
</div>
</body>
<script src="{{asset('/js/app.js')}}"></script>
{!! toastr()->render() !!}
</html>
