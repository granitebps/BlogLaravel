<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="/" class="brand-link">
		<img src="{{asset('admin/images/logo.png')}}" class="brand-image img-circle elevation-3"
		style="opacity: .8">
		<span class="brand-text font-weight-light">{{auth()->user()->name}}</span>
	</a>
	
	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="{{asset('storage/images/avatars/'.auth()->user()->profile->avatar)}}" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block">{{auth()->user()->name}}</a>
			</div>
		</div>
		
		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item">
					<a href="{{route('home')}}" class="nav-link {{request()->route()->getName() == 'home' ? 'active' : ''}}">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>
				<li class="nav-item has-treeview {{request()->is('admin/post*') ? 'menu-open' : ''}}">
					<a href="#" class="nav-link {{request()->is('admin/post*') ? 'active' : ''}}">
						<i class="nav-icon fa fa-edit fa-fw"></i>
						<p>
							Post
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{route('post.index')}}" class="nav-link {{request()->route()->getName() == 'post.index' ? 'active' : ''}}">
								<i class="far fa-circle nav-icon"></i>
								<p>Post List</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{route('post.create')}}" class="nav-link {{request()->route()->getName() == 'post.create' ? 'active' : ''}}">
								<i class="far fa-circle nav-icon"></i>
								<p>Create Post</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{route('post.trashed')}}" class="nav-link {{request()->route()->getName() == 'post.trashed' ? 'active' : ''}}">
								<i class="far fa-circle nav-icon"></i>
								<p>Trashed Post</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item has-treeview {{request()->is('admin/category*') ? 'menu-open' : ''}}">
					<a href="#" class="nav-link {{request()->is('admin/category*') ? 'active' : ''}}">
						<i class="nav-icon far fa-copy"></i>
						<p>
							Category
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{route('category.index')}}" class="nav-link {{request()->route()->getName() == 'category.index' ? 'active' : ''}}">
								<i class="far fa-circle nav-icon"></i>
								<p>Category List</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{route('category.create')}}" class="nav-link {{request()->route()->getName() == 'category.create' ? 'active' : ''}}">
								<i class="far fa-circle nav-icon"></i>
								<p>Create Category</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="{{route('tag.index')}}" class="nav-link {{request()->is('admin/tag*') ? 'active' : ''}}">
						<i class="nav-icon fa fa-tags fa-fw"></i>
						<p>
							Tag
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{route('message.index')}}" class="nav-link {{request()->is('admin/message*') ? 'active' : ''}}">
						<i class="nav-icon fa fa-envelope fa-fw"></i>
						<p>
							Message
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{route('subs.index')}}" class="nav-link {{request()->route()->getName() == 'subs.index' ? 'active' : ''}}">
						<i class="nav-icon fa fa-trophy fa-fw"></i>
						<p>
							Subscriber
						</p>
					</a>
				</li>
				<li class="nav-item has-treeview {{request()->is('admin/profile*') ? 'menu-open' : ''}}">
					<a href="#" class="nav-link {{request()->is('admin/profile*') ? 'active' : ''}}">
						<i class="nav-icon fa fa-user fa-fw"></i>
						<p>
							Profile
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{route('profile')}}" class="nav-link {{request()->route()->getName() == 'profile' ? 'active' : ''}}">
								<i class="far fa-circle nav-icon"></i>
								<p>Edit Profile</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{route('password')}}" class="nav-link {{request()->route()->getName() == 'password' ? 'active' : ''}}">
								<i class="far fa-circle nav-icon"></i>
								<p>Change Password</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="{{route('home')}}" class="nav-link" data-toggle="modal" data-target="#logoutModal">
						<i class="nav-icon fas fa-sign-out-alt"></i>
						<p>
							Logout
						</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				<form id="logout-form" action="{{ route('logout') }}" method="POST">
					@csrf
					<button type="submit" class="btn btn-primary">Logout</button>
				</form>
				{{-- <a class="btn btn-primary" href="{{ route('logout') }}">Logout</a> --}}
			</div>
		</div>
	</div>
</div>