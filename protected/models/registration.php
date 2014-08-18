<?php
error_reporting(E_ALL);
/**
* Регистрация пользователей
* @author Awe_Kyle <kyle.voronin@gmail.com>
* @version 1.0
*/
class Registration implements CheckInpValues
{
	private $login;
	private $pass;
	private $confirm_pass;
	private $email;

	function __construct($login, $pass, $confirm_pass = null, $email = null)
	{
		$this->login = $login;
		$this->pass = $pass;
		$this->confirm_pass = $confirm_pass;
		$this->email = $email;
	}

	public function checkInpValue()
	{
		$this->email = filter_var($this->email, FILTER_VALIDATE_EMAIL);
		if ($this->email === false) {
			$this->err[] = "email is incorrect";
		}

		$check_login = preg_match("/[a-zA-Z0-9]{4,25}/", $this->login);
		if ($check_login === false) {
			$this->err[] = "login is incorrect! Lengths may be below 4 and 25 charset";
		}

		$check_pass = preg_match("/[a-zA-Z0-9]{5,25}/", $this->pass);
		if ($check_pass === false) {
			$this->err[] = "Password is incorrect! Lengths may be below 5 and 25 charset";
		}

		if ($this->pass != $this->confirm_pass) {
			$this->err[] = "Password and password2 is not compatible";
		}

		$c = DB::getConn();
		$is_uniq = $c->prepare("SELECT `user_id` FROM `my_blog`.`users` 
								WHERE `login` = :login");
		$is_uniq->execute(array(':login'=>$this->login));
		if ($is_uniq->rowCount() !== 0) {
			$this->err[] = "Login is existing!";
		}


		return $this->err;
	}

	public function addNewUser()
	{
		if (sizeof($this->checkInpValue()) == 0) {
			$c = DB::getConn();
			$this->pass = md5(md5($this->pass));
			try {
				$add_user = $c->prepare("INSERT INTO `my_blog`.`users` 
											SET `login` = :login, `password` = :pass, `email` = :email");
				$exec = $add_user->execute(array(":login"=>$this->login, ":pass"=>$this->pass, ":email"=>$this->email));
			}
			catch (PDOException $e) {
				file_put_contents('../log/errors.txt', date('y-m-d') . ": " . $e->getMessage() . "\r\n");
			}
			if ($exec === true) {
				return true;
			}
			else {
				$this->err[] = "Registration is failed";
				return $this->err;
			}
		}
		else {
			return $this->err;
		}
	}
}
