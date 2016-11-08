<?php 
require_once '../vendor/autoload.php';

use App\User;

if (session_status() == PHP_SESSION_NONE) {
   	session_start();
}


if( isset($_SESSION['user']) ){
	header("Location: dashboard.php");
}

if( isset($_POST['submit']) ){

	$name = $_POST['name'];
	$company = $_POST['company'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	$user = new User();
	$user->register($name, $company, $email, $password);

}

?>
<?php include 'include/header.php'; ?>
<div class="content-wrapper">
	<div class="centered">
		<form method="post" action="index.php">
			<?php if( isset($_SESSION['error']) ): ?>
				<div class="form-group text-center alert alert-danger">
					<p><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
				</div>
			<?php endif; ?>
			<h3 class="text-center">Register</h3>
			<div class="form-group text-center">
				<p>If you already have an account login <a href="/login.php">here</a></p>
			</div>
			<div class="form-group">
				<label>Name:</label>
				<input class="form-control" type="text" name="name" value="<?php if( isset($_POST['name']) ){ echo $_POST['name']; } ?>"/>
			</div>

			<div class="form-group">
				<label>Company:</label>
				<input class="form-control" type="text" name="company" value="<?php if( isset($_POST['company']) ){ echo $_POST['company']; } ?>"/>
			</div>

			<div class="form-group">
				<label>Email:</label>
				<input class="form-control" type="text" name="email" value="<?php if( isset($_POST['email']) ){ echo $_POST['email']; } ?>"/>
			</div>

			<div class="form-group">
				<label>Password:</label>
				<input class="form-control" type="password" name="password" />
			</div>

			<div class="form-group text-center">
				<input type="submit" name="submit" class="btn btn-primary">
			</div>

		</form>
	</div>
</div>
<?php include 'include/footer.php'; ?>

