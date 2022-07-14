<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//this causes the database library to be autoloaded
		//loading of any other models would happen here   
	}

	public function login($credentials)
	{
		$email = $credentials["emailLogin"];
		$password = $credentials["passwordLogin"];

		if (empty($email) || empty($password)) {
			return 'Missing Fields <a href="' . site_url() . '/auth">try again</a>';
		}
		if (strlen($password) < 5) {
			return 'Password must be at least 5 characters long <a href="' . site_url() . '/auth">try again</a>';
		}

		$sql = "select * from users where email = '$email'";

		$query = $this->db->query($sql);

		$data = $query->row_array();

		if ($data) {
			if (password_verify($password, $data["password"])) {
				$this->session->user_id = $data["user_id"];
				$this->session->full_name = $data["full_name"];
				$this->session->role = $data["role"];
			} else return "Password is incorrect";
		} else return "Email unrecognized";
		return "You have been logged in!";
	}

	public function register($credentials)
	{
		$fullName = $credentials["fullName"];
		$email = $credentials["emailRegister"];
		$password = $credentials["passwordRegister"];

		if (empty($email) || empty($password) || empty($fullName)) {
			return 'Missing Fields <a href="' . site_url() . '/auth">try again</a>';
		}
		if (strlen($password) < 5) {
			return 'Password must be at least 5 characters long <a href="' . site_url() . '/auth">try again</a>';
		}

		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

		$sql = "INSERT INTO `users`(`full_name`, `email`, `password`, `role`) VALUES ('$fullName','$email','$hashedPassword', 0)";

		$query = $this->db->query($sql);

		if (!$query) {
			return 'Connection to the server could not be made';
		}

		$credentials = ['emailLogin' => $email, 'passwordLogin' => $password];

		return $this->login($credentials);
	}

	public function do_reset($credentials)
	{

		$email = $credentials["emailReset"];
		$password = $credentials["passwordReset"];

		if (empty($email) || empty($password)) {
			return 'Missing Fields <a href="' . site_url() . '/auth/reset">try again</a>';
		}
		if (strlen($password) < 5) {
			return 'Password must be at least 5 characters long <a href="' . site_url() . '/auth/reset">try again</a>';
		}

		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

		if (!$hashedPassword) {
			return 'Password hash failed <a href="' . site_url() . '/auth/reset">try again</a>';
		}

		$sql = "update users set password = '" . $hashedPassword . "' where email = '" . $email . "'";

		$query = $this->db->query($sql);

		if ($query) {
			return "Your password has been changed.";
		} else return "Password reset failed, please try again";
	}
}