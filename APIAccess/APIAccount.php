<?php


class APIAccount
{
	private $id;
	private $application;
	private $author;
	private $authorEmail;
	private $salt;

	public function __construct($id, $application, $author, $authorEmail, $salt)
	{
		$this->id = $id;
		$this->application = $application;
		$this->author = $author;
		$this->authorEmail = $authorEmail;
		$this->salt = $salt;
	}

	public function generateKey($name)
	{
		$uuid = $this->gen_uuid();
			
		APIKey::create($name, $uuid);
	}
	
	private function gen_uuid() 
	{
		return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
		);
	}


	public static function Load($id)
	{
	}
}
