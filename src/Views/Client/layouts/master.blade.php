<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en-us">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    @include('layouts.partials.head')
</head>

<body>

    @include('layouts.partials.nav')

    <div class="container">

         @yield('content')

    </div>

    @include('layouts.partials.footer')
    


    @include('layouts.partials.script')
</body>

</html>
