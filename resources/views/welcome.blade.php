<!DOCTYPE HTML>
<html lang="{{ app()->getLocale() }}">
<head>
<title>Online Login Form Responsive Widget Template :: w3layouts</title>
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Online Login Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Meta tag Keywords -->
<!-- css files -->
<link rel="stylesheet" href="/css/login/style.css" type="text/css" media="all" /> <!-- Style-CSS --> 
<link rel="stylesheet" href="css/login/font-awesome.css"> <!-- Font-Awesome-Icons-CSS -->
<!-- //css files -->
<!-- online-fonts -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800&amp;subset=latin-ext" rel="stylesheet">
<!-- //online-fonts -->
</head>
<body>
<!-- main -->
<div class="center-container">
	<!--header-->
	<div class="header-w3l">
		<img src="/img/logocolor.jpg" width="150px"></img>
	</div>
	<!--//header-->
	<div class="main-content-agile">
		<div class="sub-main-w3">	
			<div class="wthree-pro">
				<h2>Inicio de sesión</h2>
			</div>
			<form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
				<div class="pom-agile">
					<input id="email" placeholder="Email" type="email" name="email" value="{{ old('email') }}" required>
					<span class="icon1"><i class="fa fa-user" aria-hidden="true"></i></span>
					@if ($errors->has('email'))
						<span class="help-block">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
					@endif
				</div>
				<div class="pom-agile">
					<input  placeholder="Password" id="password" type="password" class="form-control" name="password" required>
					<span class="icon2"><i class="fa fa-unlock" aria-hidden="true"></i></span>
					@if ($errors->has('password'))
						<span class="help-block">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
					@endif
				</div>
				<div class="sub-w3l">
					<h6><a href="{{ route('password.request') }}">Olvido su contraseña?</a></h6>
					<div class="right-w3l">
						<input type="submit" value="Ingresar">
					</div>
				</div>
			</form>
		</div>
	</div>
	<!--//main-->
	<!--
	<div class="footer">
		<p>&copy; 2017 Online Login Form. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
	</div>
	-->
</div>
</body>
</html>