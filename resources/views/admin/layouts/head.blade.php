<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Way Shop Admin Panel')</title>
    <meta name="csrf_token" content="{{ csrf_token() }}">
    @include('admin.layouts.partials.styles')
</head>