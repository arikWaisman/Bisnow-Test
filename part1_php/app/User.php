<?php  

namespace App;

use App\DB_Connection;

class User
{

	private $db;

	public function __construct(){

		require_once '../vendor/autoload.php';
		$this->db = new DB_Connection();
		$this->db = $this->db->db_connect();

	}

	public function register($name, $company, $email, $password){

		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if( !empty($name) && !empty($company) && !empty($email) && !empty($password)){

			$hashed_password = md5($password);

			$query = $this->db->prepare( 'INSERT INTO users(name,company,email, password) 
											VALUES(:name, :company, :email, :password)');

			$query->bindParam(':name', $name);
			$query->bindParam(':company', $company);
			$query->bindParam(':email', $email);
			$query->bindParam(':password', $hashed_password);
			$query->execute();
			$result = $query->rowCount();

			if( $result > 0 ){
				$_SESSION['message'] = 'thank you for creating an account, please login!!';
				unset($_SESSION['error']);
				header("Location: login.php");
			}

		} else {
		
			$_SESSION['error'] = "All fields must be filled out";

		}
		
	}

	public function login($email, $password){

		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if( !empty($email) && !empty($password) ){

			$hashed_password = md5($password);

			$query = $this->db->prepare('SELECT * FROM users WHERE email=:email');
			$query->bindParam(':email', $email);
			$query->execute();
			$user_row = $query->fetch(\PDO::FETCH_ASSOC);

			if( $query->rowCount() > 0 ){
				if( $hashed_password  == $user_row['password']){
					$_SESSION['user'] = $user_row;
					header("Location: dashboard.php");
				} else{
					$_SESSION['error'] = "incorrect email or password";
					return false;
				}
				
			} 

		} else {
			
			$_SESSION['error'] = "name and password can not be empty and are required";

		}

	}

	public function logout(){

		session_destroy();
		unset($_SESSION['user']);
		header("Location: login.php");
		return true;

	}


}