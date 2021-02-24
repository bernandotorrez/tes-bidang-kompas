
<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>{{ config('app.name') }} - Login</title>
		<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="icon" href="favicon.ico" type="image/x-icon">

		<!-- Toggles CSS -->
		<link href="{{ asset('vendors/jquery-toggles/css/toggles.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ asset('vendors/jquery-toggles/css/themes/toggles-light.css') }}" rel="stylesheet" type="text/css">

		<!-- Custom CSS -->
		<link href="{{ asset('dist/css/style.css') }}" rel="stylesheet" type="text/css">
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
									<a class="auth-brand text-center d-block mb-20" href="#">
										<img class="brand-img w-25 h-25" src="{{ asset('dist/img/kompas.png') }}" alt="brand"/>
									</a>
									<form method="POST" id="login-form">
										<p class="text-center mb-30">Welcome to {{ config('app.name') }} Application</p>
                                        <p>
                                            <div id="message"></div>
                                        </p>
										<div class="form-group">
											<input class="form-control" id="username" name="username" placeholder="Username" type="text">
                                            <div class="invalid-feedback validation" data-field="username"></div>
										</div>
										<div class="form-group">
											<div class="input-group">
												<input class="form-control" id="password" name="password" placeholder="Password" type="password">
                                                <div class="invalid-feedback validation" data-field="password"></div>
											</div>
										</div>
										<button class="btn btn-primary btn-block" type="submit" id="login-button">Login</button>
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
		<script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="{{ asset('vendors/popper.js/dist/umd/popper.min.js') }}"></script>
		<script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>

		<!-- Slimscroll JavaScript -->
		<script src="{{ asset('dist/js/jquery.slimscroll.js') }}"></script>

		<!-- Fancy Dropdown JS -->
		<script src="{{ asset('dist/js/dropdown-bootstrap-extended.js') }}"></script>

		<!-- FeatherIcons JavaScript -->
		<script src="{{ asset('dist/js/feather.min.js') }}"></script>

		<!-- Init JavaScript -->
		<script src="{{ asset('dist/js/init.js') }}"></script>

        <script>
            $('#login-form').submit(function(e) {
                e.preventDefault()

                var data = $(this).serialize()
                var loginButtonEl = $('#login-button')
                var validationEl = $('.validation')

                $.ajax({
                    url: '{{ route('login.login') }}',
                    method: 'POST',
                    dataType: 'JSON',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    beforeSend: function() {
                        loginButtonEl.prop('disabled', true)
                        $.each(validationEl, function(key, val) {
                            val.innerHTML = ''
                        })
                    },
                    success: function(response) {
                        loginButtonEl.prop('disabled', false)

                        var status = response.status
                        var message = response.message

                        if(status == 'success') {
                            $('#message').html('')
                            window.location.href = '{{ route('home.index') }}'
                        } else {
                            $('#message').html('<div class="alert alert-danger text-center">'+message+'</div>')
                        }
                    },
                    error: function(err) {
                        loginButtonEl.prop('disabled', false)
                        if(err.status == 422) {
                            $.each(err.responseJSON.errors, function (i, error) {
                                $('[data-field="'+i+'"]').html(error[0]).css('display', 'block')
                            });
                        } else {
                            $('#message').html('Ops, ada suatu Masalah di Sistem')
                        }

                    }
                })
            })
            </script>
	</body>
</html>
