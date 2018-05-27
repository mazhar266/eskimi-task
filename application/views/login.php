<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?php echo base_url (); ?>assets/css/bootstrap.min.css">

	<title>Login</title>
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<h1>&nbsp;</h1>
			<?php if (isset($msg)): ?>
				<div class="alert alert-danger" role="alert">
					<?php echo $msg; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<form action="<?php echo base_url (); ?>" method="post">
				<div class="form-group">
					<label for="exampleInputEmail1">Username</label>
					<input type="text" name="username" class="form-control" aria-describedby="emailHelp"
						   placeholder="Enter email">
					<small id="emailHelp" class="form-text text-muted">Default Username: Admin</small>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Password</label>
					<input type="password" name="password" class="form-control" placeholder="Password">
					<small id="emailHelp" class="form-text text-muted">Default Password: Admin</small>
				</div>
				<button type="submit" class="btn btn-primary btn-block">Login</button>
			</form>
		</div>
	</div>
</div>

<!-- Optional JavaScript -->
<script src="<?php echo base_url (); ?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url (); ?>assets/js/bootstrap.min.js"></script>
</body>
</html>