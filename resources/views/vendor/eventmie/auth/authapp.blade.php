@extends('eventmie::layouts.app')

@section('content')      
<div class="row d-flex align-items-center justify-content-center">
	<div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12 py-10">
		<!--lgx-registration-banner-box-->
		@yield('authcontent')
	</div>
</div>
@endsection
