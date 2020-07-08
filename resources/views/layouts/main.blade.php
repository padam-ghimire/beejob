<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BEE Job</title>
       <!-- Styles -->
       {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
       <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
       <link rel="stylesheet" href="{{ asset('css/style.css') }}">
       @include('../includes/top')

</head>
<body>
    @include('../includes/navbar')
    @yield('content')
    @include('../includes/footer')

</body>
</html>