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

	$email = $_POST['email'];
	$password = $_POST['password'];

	$user = new User();
	$user->login($email, $password);

}

?>
<?php include 'include/header.php'; ?>
<div class="content-wrapper">
	<div class="centered">
		<form method="post" action="login.php">
			<?php if( isset($_SESSION['error']) ): ?>
				<div class="form-group text-center alert alert-danger">
					<p><?php echo $_SESSION['error']; unset($_SESSION['error']) ?></p>
				</div>
			<?php endif; ?>
			<?php if( isset($_SESSION['message']) ): ?>
				<div class="form-group text-center alert alert-success">
					<p><?php echo $_SESSION['message']; unset($_SESSION['message']) ?></p>
				</div>
			<?php endif; ?>
			<h3 class="text-center">Login</h3>
			<div class="form-group text-center">
				<p>If you need to create an account click <a href="/index.php">here</a></p>
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

