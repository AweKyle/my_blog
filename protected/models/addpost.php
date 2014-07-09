<?php
/**
* 
*/
class AddPost implements CheckInpValues
{
	public $title;	//title
	public $content;	//note
	//public $author_id;	//author
	public $date_created;	//when was added
	public $tags;	//imploded array of tags

	function __construct($title, $content, $tags)
	{
		$this->title = $title;
		$this->content = $content;
		//$this->author_id = $author_id;
		$this->tags = $tags;
		$this->date_created = date('y-m-d');
	}

	public function checkInpValue()
	{
		$check_title = preg_match("/[a-zA-Z0-9]{4,200}/", $this->title);
		if ($check_login === false) {
			$this->err[] = 'title is incorrect! Lengths may be below 4 and 200 charset';
		}

		if (strlen($this->content < 10)) {
			$this->err[] = 'Заметка слишком короткая';
		}

		if (strlen($this->tags > 200)) {
			$this->err[] = 'Слишком много тэгов, или имена тэгов слишком длинные';
		}
	}

	public function createPost()
	{
		$c = DB::getConn();
		try {
			$create_post = $c->prepare("INSERT INTO `my_blog`.`post` 
										SET `title` = :title, `content` = :content, 
										`date_created` = :date_created, `tags` = :tags");
			$exec = $create_post->execute(array(':title'=>$this->title, ':content'=>$this->content, 
												':date_created'=>$this->date_created, ':tags'=>$this->tags);	
		} catch (PDOException $e) {
			file_put_contents('../log/errors.txt', date('y-m-d') . ": " . $e->getMessage() . "\r\n");
		}

		if ($exec === true) {
			return true;
		}
		else {
			$this->err[] = 'Возникла непредвиденная ошибка. Создать запись не удалось';
		}
	}
}