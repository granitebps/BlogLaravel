<nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
			<a href="index3.html" class="nav-link">Home</a>
		</li>
	</ul>
	
	<!-- SEARCH FORM -->
	<form action="{{route('post.index')}}" method="GET" class="form-inline ml-3">
		<div class="input-group input-group-sm">
			<input class="form-control form-control-navbar" type="search" name="search" placeholder="Search Post" aria-label="Search">
			<div class="input-group-append">
				<button class="btn btn-navbar" type="submit">
					<i class="fas fa-search"></i>
				</button>
			</div>
		</div>
	</form>
	
	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">
		<!-- Notifications Dropdown Menu -->
		<li class="nav-item dropdown">
			<a class="nav-link" data-toggle="dropdown" href="#">
				<i class="far fa-bell"></i>
				<span class="badge badge-warning navbar-badge">{{\App\Models\Blog\TaskModel::count()}}</span>
			</a>
			<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
				<span class="dropdown-item dropdown-header">{{\App\Models\Blog\TaskModel::count()}} Tasks</span>

				@foreach (\App\Models\Blog\TaskModel::get_task() as $row)
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item">
					<i class="fas fa-file mr-2"></i> {{$row->task}}
					<span class="float-right text-muted text-sm">{{date('l d F Y', strtotime($row->deadline))}}</span>
				</a>
				@endforeach

				<div class="dropdown-divider"></div>
				<a href="{{route('task.index')}}" class="dropdown-item dropdown-footer">See All Notifications</a>
			</div>
		</li>
	</ul>
</nav>