
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Lupa Password | PPDB Al-Azhar Syifa Budi Cibubur</title>
	<base href="{{\URL::to('/')}}">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/my-login.css">
	<link rel="shortcut icon" href="img/mdw-logo.jpg">
</head>
<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center align-items-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="img/mdw-logo.jpg" alt="bootstrap 4 login page">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Lupa Password</h4>
							<form method="POST" class="my-login-validation" novalidate="" action="{{ route('password.email') }}">
								@csrf
								@if (session('status'))
								<div class="alert alert-success">
									{{ session('status') }}
								</div>
								@endif
								<div class="form-group">
									<label for="email">Alamat E-Mail</label>
									<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
									 <span class="text-danger">@error('email'){{ $message }} @enderror</span>
									<div class="form-text text-muted">
										Dengan mengklik "Reset Kata Sandi" kami akan mengirimkan link reset password
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">
										Reset Kata Sandi
									</button>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; 2021 &mdash; Your Company 
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="js/my-login.js"></script>
</body>
</html>