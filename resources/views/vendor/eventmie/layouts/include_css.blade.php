<!-- Packages CSS -->
<link rel="stylesheet" href="{{ eventmie_asset('css/vendor.css') }}">

<!-- Bootstrap RTL CSS only if langauge is RTL -->
@if (is_rtl())
    <link rel="stylesheet" href="{{ eventmie_asset('css/bootstrap-rtl.min.css') }}">
@endif

<!-- New Themese Theme CSS -->
<link rel="stylesheet" href="{{ eventmie_asset('css/theme.css') }}">
<link rel="stylesheet" href="{{ eventmie_asset('css/theme-custom.css') }}">

{{-- CUSTOM --}}
<link rel="stylesheet" href="{{ asset('css/eventmie-custom.css') }}?v=2.1">
{{-- CUSTOM --}}
