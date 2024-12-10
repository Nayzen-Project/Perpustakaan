
 <!doctype html>
<html>
  <head>
    <link rel="canonical" href="#">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="{{ config('app.authors') }}">
    <meta name="generator" content="Laravel">

    <title>{{ $title }}</title>

    {{-- Include stylesheets --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Include favicons --}}
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="icon" type="image/png" href="/favicon.ico">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    {{-- Robots meta --}}
    @if(isset($params['robots']))
    <meta name="robots" content="{{ $params['robots'] }}">
    @endif

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    {{-- Additional custom CSS --}}
    @if(isset($pageParams['extra_css']))
        @foreach($pageParams['extra_css'] as $css)
            <link href="{{ $css }}" rel="stylesheet">
        @endforeach
    @endif
  </head>
  <body @if(isset($pageParams['body_class'])) class="{{ $pageParams['body_class'] }}" @endif>
    @include('admin.layouts.partials.navbar')
    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">

      @include('admin.layouts.partials.sidebar')

      <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
        <main>
          @yield('content')
        </main>
            @include('admin.layouts.partials.footer')
      </div>
    </div>
  </body>
</html>

