<?php
namespace App\Controllers;

use App\Systems\Validation\FormValidation;
use App\Models\AuthModel;

class AuthController
{
	public $name;
	public $email;
	public $password;
	public $old_password;
	public $new_password;
	public $confirm_password;
	public $validation;
	public $auth;

	public function __construct()
	{
		$this->validation = new FormValidation();
		$this->auth = new AuthModel();
	}

	/**
	 * User Registration
	 */
	public function register($inputData = array())
	{
		//added post value in a variable and trim
		$this->name = $this->validation->trimValidate($inputData['name']);
		$this->email = $this->validation->trimValidate($inputData['email']);
		$this->password = $this->validation->trimValidate($inputData['password']);
		$this->confirm_password = $this->validation->trimValidate($inputData['confirm_password']);

		$error = array();

		//if post data is empty
		if (empty($this->name) OR empty($this->email) OR empty($this->password) OR empty($this->confirm_password)) {

			//set error variable for session
			if (empty($this->name)) {
				$error['name_error'] = "Name can't be empty!";
			}
			if (empty($this->email)) {
				$error['email_error'] = "E-mail can't be empty!";
			}
			if (empty($this->password)) {
				$error['password_error'] = "Password can't be empty!";
			}
			if (empty($this->confirm_password)) {
				$error['confirm_password_error'] = "Confirm Password can't be empty!";
			}
			$_SESSION['form_error'] = $error;
			header('location: register.php');
		} else {
			//check valid email
			if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
				$error['email_error'] = "Invalid e-mail!";
				$_SESSION['form_error'] = $error;
				header('location: register.php');
			} elseif ($this->password != $this->confirm_password) {
				$error['confirm_password_error'] = "Confirm Password don't match!";
				$_SESSION['form_error'] = $error;
				header('location: register.php');
			} else {
				//if already email exist
				if ($this->auth->selectAnUser($this->email)->num_rows == 1) {
					$error['email_error'] = "E-mail already exist!";
					$_SESSION['form_error'] = $error;
					header('location: register.php');
				} else {
					//confirm registration
					$this->password = password_hash($this->password, PASSWORD_BCRYPT);
					$this->auth->userInsert($this->name, $this->email, $this->password);
					$_SESSION['message'] = 'Registration successfully! Now, you can login.';
					$_SESSION['alert-type'] = 'success';
					header('location: login.php');
				}
			}
			
		}
	}

	/**
	 * User login
	 */
	public function login($inputData = array())
	{
		//added post value in a variable and trim
		$this->email = $this->validation->trimValidate($inputData['email']);
		$this->password = $this->validation->trimValidate($inputData['password']);

		$error = array();

		//if post data is empty
		if (empty($this->email) OR empty($this->password)) {

			//set error variable for session
			if (empty($this->email)) {
				$error['email_error'] = "E-mail can't be empty!";
			}
			if (empty($this->password)) {
				$error['password_error'] = "Password can't be empty!";
			}
			$_SESSION['form_error'] = $error;
			header('location: login.php');
		} else {
			//check user exist
			if ($this->auth->selectAnUser($this->email)->num_rows == 1) {
				$user = $this->auth->selectAnUser($this->email);
				$user = $user->fetch_object();
				//check password
				if (password_verify($this->password, $user->password)) {
					$this->password = $user->password;
					//if email and password match, go to home page
					if ($this->auth->userLogin($this->email, $this->password)->num_rows == 1) {
						$userAuth = array();
						$userAuth['id'] = $user->id;
						$userAuth['name'] = $user->name;
						$userAuth['email'] = $user->email;
						$userAuth['login'] = TRUE;
						$_SESSION['userAuth'] = $userAuth;

						$_SESSION['message'] = "You are logged in!";
						$_SESSION['alert-type'] = 'success';
						header('location: index.php');
					} else {
						$_SESSION['message'] = "Something went wrong!";
						$_SESSION['alert-type'] = 'error';
						header('location: login.php');
					}
				} else {
					//email or password doesn't match
					$_SESSION['message'] = "E-mail or Password didn't match";
					$_SESSION['alert-type'] = 'error';
					header('location: login.php');
				}
			} else {
				$_SESSION['message'] = "E-mail or Password didn't match";
				$_SESSION['alert-type'] = 'error';
				header('location: login.php');	
			}
			
		}
	}

	/**
	 * User profile information update
	 */
	public function profileUpdate($inputData = array())
	{
		//added post value in a variable and trim
		$this->name = $this->validation->trimValidate($inputData['name']);
		$this->email = $this->validation->trimValidate($inputData['email']);
		$this->old_password = $this->validation->trimValidate($inputData['old_password']);
		$this->new_password = $this->validation->trimValidate($inputData['new_password']);
		$this->confirm_password = $this->validation->trimValidate($inputData['confirm_password']);

		$error = array();

		//if post data is empty
		if (empty($this->name) OR empty($this->email)) {

			//set error variable for session
			if (empty($this->name)) {
				$error['name_error'] = "Name can't be empty!";
			}
			if (empty($this->email)) {
				$error['email_error'] = "E-mail can't be empty!";
			}
			$_SESSION['form_error'] = $error;
			header('location: profile_edit.php');
		} else {
			if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
				$error['email_error'] = "Invalid e-mail!";
				$_SESSION['form_error'] = $error;
				header('location: profile_edit.php');
				die();
			}
			//if user don't want to change password
			if (empty($this->old_password)) {
				$this->auth->simpleProfileUpdate($this->name, $this->email);

				$userAuth = array();
				$userAuth['id'] = $_SESSION['userAuth']['id'];
				$userAuth['name'] = $this->name;
				$userAuth['email'] = $this->email;
				$userAuth['login'] = TRUE;
				$_SESSION['userAuth'] = $userAuth;

				$_SESSION['message'] = 'Profile updated successfully!';
				$_SESSION['alert-type'] = 'success';
				header('location: profile.php');
			} else {
				//user want to change profile to changing password
				$user = $this->auth->selectAnUser($_SESSION['userAuth']['email']);
				$user = $user->fetch_object();
				if (password_verify($this->old_password, $user->password)) {
					if ($this->new_password == $this->confirm_password) {
						$this->password = password_hash($this->new_password, PASSWORD_BCRYPT);
						$this->auth->fullProfileUpdate($this->name, $this->email, $this->password);
						unset($_SESSION['userAuth']);
						$_SESSION['message'] = 'Successfully profile updated! Now, login.';
						$_SESSION['alert-type'] = 'success';
						header('location: login.php');
					} else {
						$_SESSION['message'] = "New Password and Confirm Password doesn't Match!";
						$_SESSION['alert-type'] = "error";
						header('location: profile_edit.php');
					}
				} else {
					$error['old_password_error'] = "Old Password didn't match!";
					$_SESSION['form_error'] = $error;
					header('location: profile_edit.php');
				}
			}
			
		}
	}

	/**
	 * User account permanently delete
	 */
	public function deleteAccount()
	{
		$this->auth->deleteUser($_SESSION['userAuth']['id']);
	}

}