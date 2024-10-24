<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<title>Connexion || SYSTEME DE GESTION INTEGRE - ANP</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" href="{{ asset('img/mini_logo.png') }}" type="image/png">
    <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('auth/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('auth/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('auth/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('auth/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('auth/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('auth/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('auth/css/main.css') }}">
    <!--===============================================================================================-->

    @notifyCss
    
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{ asset('img/logo.png') }}" alt="IMG">
				</div>

				<form method="POST" action="{{ route('connexion') }}" class="login100-form validate-form">
                    @csrf

					<span class="login100-form-title">SYSTEME DE GESTION INTEGRE</span>
                    <span class="login100-form-title">------<br/><br/>Authentification</span>

					<div class="wrap-input100">
						<input type="text" name="username" class="input100"  placeholder="Nom utilisateur">

						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100">
						<input type="password" name="password" class="input100" placeholder="Mot de passe">

						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn" style="background: #2fac66;">
							Se connecter
						</button>
					</div>

                    {{-- <div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="#">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div> --}}
				</form>
			</div>
		</div>
        <x-notify::notify />
	</div>

<!--===============================================================================================-->
	<script src="{{ asset('auth/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('auth/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('auth/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('auth/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('auth/vendor/tilt/tilt.jquery.min.js') }}"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>

    {{-- @include('notify::components.notify') --}}
    @notifyJs
<!--===============================================================================================-->
	<script src="{{ asset('auth/js/main.js') }}"></script>

</body>
</html>
