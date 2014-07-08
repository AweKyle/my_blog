<?php
error_reporting(E_ALL);
/**
* 
*/
class Authorization implements CheckInpValues
{
	public $user_hash;
	public $user_id;

	public function checkInpValue()
	{
		$c = DB::getConn();
		$this->pass = md5(md5($this->pass));
		$check_inp_values = $c->prepare("SELECT `user_id`, `password` FROM `my_blog`.`users` 
											WHERE `login` = :login");
		$check_inp_values->execute(array(':login'=>$this->login));
		if ($check_inp_values->rowCount() == 0) {
			$this->err[] = 'Incorrect login.';
			return $this->err;
		}
		else {
			$userInf = $check_inp_values->fetch(PDO::FETCH_ASSOC); 
			if ($userInf['password'] === $this->pass) {
				$this->user_id = $userInf['user_id'];	
			}
			else {
				$this->err[] = 'incorrect password.';
			}
			return $this->err;	
		}
	}

	private function generateCode($length=6)
	{
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";

		$code = "";

		$clen = strlen($chars) - 1; 
		while (strlen($code) < $length) {
			$code .= $chars[mt_rand(0,$clen)]; 
		}

		return $code;
	}

	public function login()
	{
		if (sizeof($this->checkInpValue()) == 0) {
			$this->user_hash = md5(md5($this->generateCode(10)));
			$c = DB::getConn();
			$user_update = $c->prepare("UPDATE `my_blog`.`users` 
												SET `user_hash` = :hash
												WHERE `login` = :login");
			$exec = $user_update->execute(array(':hash'=>$this->user_hash, ':login'=>$this->login));
			/*
			 *Косяк с куками. надо будет поправить
			 */
			//$this->cookies($this->user_id, $this->user_hash);
			//setcookie('id', $authorization->user_id, time()+60*60*24*30);
			//setcookie('hash', $this->user_hash, time()+60*60*24*30);
			session_start($this->user_hash);
			$_SESSION['user_id'] = $this->user_id;
			$_SESSION['user_hash'] = $this->user_hash;
			return true;
		}
		else {
			return $this->err;
		}
	}
}