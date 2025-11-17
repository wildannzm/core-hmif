<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>HMIF UNMA | {{ $title }}</title>

<!-- SEO Meta Tags (only for public domain) -->
@if (isset($seoDescription))
    <meta name="description" content="{{ $seoDescription }}" />
@endif

@if (isset($seoKeywords))
    <meta name="keywords" content="{{ $seoKeywords }}" />
@endif

@if (request()->getHost() === 'internal.hmifunma.web.id')
    <!-- Prevent internal site from being indexed -->
    <meta name="robots" content="noindex, nofollow" />
@else
    <!-- Allow public site to be indexed -->
    <meta name="robots" content="index, follow" />
    <meta name="author" content="HMIF UNMA" />

    <!-- Open Graph Meta Tags -->
    @if (isset($seoTitle))
        <meta property="og:title" content="{{ $seoTitle }}" />
    @else
        <meta property="og:title" content="HMIF UNMA | {{ $title }}" />
    @endif

    @if (isset($seoDescription))
        <meta property="og:description" content="{{ $seoDescription }}" />
    @endif

    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ asset('images/Logo HMIF.png') }}" />
    <meta property="og:site_name" content="HMIF UNMA" />

    <!-- Twitter Card Meta Tags -->
    @if (isset($seoTitle))
        <meta name="twitter:title" content="{{ $seoTitle }}" />
    @else
        <meta name="twitter:title" content="HMIF UNMA | {{ $title }}" />
    @endif

    @if (isset($seoDescription))
        <meta name="twitter:description" content="{{ $seoDescription }}" />
    @endif

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:image" content="{{ asset('images/Logo HMIF.png') }}" />

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}" />
@endif

<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
<link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@vite(['resources/css/app.css', 'resources/js/app.js'])
