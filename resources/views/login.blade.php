<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>Login</title>
		<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />

		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="icon" href="favicon.ico" type="image/x-icon">

		<!-- Toggles CSS -->
        <link href="{{asset('/vendors/jquery-toggles/css/toggles.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('/vendors/jquery-toggles/css/themes/toggles-light.css')}}" rel="stylesheet" type="text/css">

		<!-- Custom CSS -->
		<link href="{{asset('dist/css/style.css')}}" rel="stylesheet" type="text/css">
	</head>
	<body>
		<!-- Preloader -->
		<div class="preloader-it">
			<div class="loader-pendulums"></div>
		</div>
		<!-- /Preloader -->

		<!-- HK Wrapper -->
		<div class="hk-wrapper">

			<!-- Main Content -->
			<div class="hk-pg-wrapper hk-auth-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xl-12 pa-0">
							<div class="auth-form-wrap pt-xl-0 pt-70">
								<div class="auth-form w-xl-30 w-lg-55 w-sm-75 w-100">
									<form action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <h1 class="display-4 text-center mb-10">Welcome</h1>
										<p class="text-center mb-30">Login in to your account</p>
										<div class="form-group">
											<input class="form-control" placeholder="Email" type="email" name="email" value="admin@mail.com">
										</div>
										<div class="form-group">
											<div class="input-group">
												<input class="form-control" value="password" name="password" placeholder="Password" type="password">
												<div class="input-group-append">
													<span class="input-group-text"><span class="feather-icon"><i data-feather="eye-off"></i></span></span>
												</div>
											</div>
										</div>
										<button class="btn btn-primary btn-block" type="submit">Login</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Main Content -->

		</div>
		<!-- /HK Wrapper -->

		<!-- JavaScript -->

		<!-- jQuery -->
		<script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="{{asset('vendors/popper.js/dist/umd/popper.min.js')}}"></script>
		<script src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>

		<!-- Slimscroll JavaScript -->
		<script src="{{asset('dist/js/jquery.slimscroll.js')}}"></script>

		<!-- Fancy Dropdown JS -->
		<script src="{{ asset('dist/js/dropdown-bootstrap-extended.js') }}"></script>

		<!-- FeatherIcons JavaScript -->
		<script src="{{asset('dist/js/feather.min.js')}}"></script>

		<!-- Init JavaScript -->
		<script src="{{asset('dist/js/init.js')}}"></script>
	</body>
</html>
