<div class="top-header-area">
	<div id="sticker">
		<div>
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<!-- logo -->
						<div class="site-logo">
							<a href="/dashboard">
								<img src="{{asset('assets/img/logo.png')}}" alt="">
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav style="background-color: #041922" class="main-menu">
							<ul>
								
								@if(auth()->check() && auth()->user()->is_admin == 1)
								<li class="#"><a href="/home">Article menu</a></li>
								@endif
								
								
								<li><a href="/dashboard">Dashboard</a></li>
								<li><a href="/news">News</a></li>
								@guest
									@if (Route::has('login'))
									<li class="nav-item">
										<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
									</li>
									@endif
								@else
								<li>
									<div class="header-icons">
									<!-- <li class="nav-item dropdown">
								
										
									</li> -->
										<a id="navbarDropdown" href="#" class="mr-5 nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre >
											@if(auth()->check() && auth()->user()->is_admin == 1)
											<i class="fas fa-crown"></i> {{ Auth::user()->name }}</a>
											@endif
											<i class="fas fa-user"></i> {{ Auth::user()->name }}</a>
										
										
										<div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
											@if(auth()->check() && auth()->user()->is_admin == 1)
											<a style="color: black;" class="dropdown-item" href="/home">Article manu</a>
											@endif
											<a style="color: black;" href="{{ route('users.index') }}">
												Settings
											</a><br>
											<a style="color: black;" href="{{ route('logout') }}"
											onclick="event.preventDefault();
															document.getElementById('logout-form').submit();">
												{{ __('Logout') }}
											</a>

											<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
												@csrf
											</form>
										</div>
										<!-- <a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a> -->
									</div>
								</li>
								@endguest
							</ul>
						</nav>
						<a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
						<div class="mobile-menu"></div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end header -->
</div>