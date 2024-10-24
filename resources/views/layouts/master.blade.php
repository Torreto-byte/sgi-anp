<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>@yield('title') || SYSTEME DE GESTION INTEGRE - ANP</title>

        @notifyCss

        {{--  include header   --}}
        @include('layouts.partials.header')

    </head>

    <body class="crm_body_bg">

        {{-- include sidebar --}}
        @include('layouts.partials.sidebar')

        <section class="main_content dashboard_part large_header_bg">

            {{-- include topbar --}}
            @include('layouts.partials.topbar')

            <div class="main_content_iner overly_inner">
                <div class="container-fluid p-0">

                    {{-- include content --}}
                    @yield('content')

                </div>

                <x-notify::notify />
            </div>

            {{-- include copyrigth --}}
            @include('layouts.partials.copyrigth')

        </section>

        <div id="back-top" style="display: none;">
            <a title="Go to Top" href="#">
                <i class="ti-angle-up"></i>
            </a>
        </div>

        {{-- include copyrigth --}}
        @include('layouts.partials.footer')

        {{-- @include('notify::components.notify') --}}
        @notifyJs

    </body>

</html>
