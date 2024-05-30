<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Meta --}}
    @yield('seo')
    {{-- Favicon --}}
    <?php $admin_favicon = Voyager::setting('site.favicon'); ?>
    @if($admin_favicon == '')
        <link rel="shortcut icon" href="/src/image/logo_artisan.png" type="image/x-icon" sizes="auto">
    @else
        <link rel="shortcut icon" href="{{ Voyager::image($admin_favicon) }}" type="image/x-icon" sizes="auto">
    @endif
    <!-- Animate on Scroll -->
    <link rel="stylesheet" href="/lib/aos/dist/aos.css" />
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="/lib/bootstrap/dist/bootstrap.min.css">
    <!-- Owl Carousel 2 -->
    <link rel="stylesheet" href="/lib/owlcarousel/dist/owl.carousel.min.css">
    <link rel="stylesheet" href="/lib/owlcarousel/dist/owl.theme.min.css">

    <!-- Internal CSS -->
    <link rel="stylesheet" href="/src/css/style.css">

    @yield('inhead')
</head>
<body>

    @yield('content')            

    <!-- Jquery -->
    <script src="/lib/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 5 -->
    <script src="/lib/bootstrap/dist/bootstrap.bundle.min.js"></script>
    <!-- Owl Carousel 2 -->
    <script src="/lib/owlcarousel/dist/owl.js"></script>
    <!-- Iconify -->
    <script src="/lib/iconify/dist/iconify.min.js"></script>
    <!-- Animate on Scroll -->
    <script src="/lib/aos/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    @yield('beforebody')

</body>
</html>