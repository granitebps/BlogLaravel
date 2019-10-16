<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{\App\Models\Blog\User::first()->name}} | {{$title}}</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	{{-- CSRF --}}
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	{{-- File Manager --}}
	<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
	{{-- Notify --}}
	@notify_css
	@yield('style')
</head>
<body class="hold-transition sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">
		<!-- Navbar -->
		@include('layouts.admin_navbar')
		<!-- /.navbar -->
		
		<!-- Main Sidebar Container -->
		@include('layouts.admin_sidebar')
		
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1>{{$title}}</h1>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>
			
			<!-- Main content -->
			<section class="content">
				
				@yield('content')
				
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		
		@include('layouts.admin_footer')
		
		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->
	
	<!-- jQuery -->
	<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
	<!-- Bootstrap 4 -->
	<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
	<!-- FastClick -->
	<script src="{{asset('admin/plugins/fastclick/fastclick.js')}}"></script>
	<!-- AdminLTE App -->
	<script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
	
	{{-- SweetAlert --}}
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.33.1/dist/sweetalert2.all.min.js"></script>
	
	{{-- File Manager --}}
	<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
	
	{{-- Notify --}}
	@if ($errors->count() > 0)
		@foreach ($errors->all() as $error)
			{{notify()->error($error)}}
		@endforeach
	@endif

	@yield('script')
</body>
@notify_js
@notify_render
</html>