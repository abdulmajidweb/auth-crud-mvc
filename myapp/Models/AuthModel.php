<?php
namespace App\Models;

/**
 * User Authentication model
 */
class AuthModel extends MyModel
{
	//select one user
	public function selectAnUser($email)
	{
		$sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
		return $this->conn->query($sql);
	}
	//insert user for new registration
	public function userInsert($name, $email, $password)
	{
		$sql = "INSERT INTO users VALUES(NULL, '$name', '$email', '$password')";
		$this->conn->query($sql);
	}

	//check login for user
	public function userLogin($email, $password)
	{
		$sql = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
		return $this->conn->query($sql);
	}

	//if onle change to profile name and email
	public function simpleProfileUpdate($name, $email)
	{
		$id = $_SESSION['userAuth']['id'];
		$sql = "UPDATE users
				SET name = '$name',
				email = '$email'
				WHERE id = $id";
		return $this->conn->query($sql);
	}

	//if change full profile with password
	public function fullProfileUpdate($name, $email, $password)
	{
		$id = $_SESSION['userAuth']['id'];
		$sql = "UPDATE users
				SET name = '$name',
				email = '$email',
				password = '$password'
				WHERE id = $id";
		return $this->conn->query($sql);
	}

	//permanentle delete account
	public function deleteUser($id)
	{
		$sql = "DELETE FROM users WHERE id = $id";
		$this->conn->query($sql);
	}
}