<?php
require_once '../vendor/autoload.php';

use App\User;

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if( !isset($_SESSION['user']) ){
	header("Location: login.php");
}

if( isset($_POST['submit']) ){
	$user = new User();
	$user->logout();
}
?>

<?php include 'include/header.php'; ?>

<div class="content-wrapper">
	<div class="centered text-center">
		<h1>You are logged in <?php echo $_SESSION['user']['name'] ?>!!</h1>
		<form method="post" action="dashboard.php">
			<input type="submit" name="submit" value="logout" class="btn btn-danger">
		</form>
	</div>
</div>

<?php include 'include/footer.php'; ?>

		