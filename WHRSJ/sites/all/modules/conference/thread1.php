<?php


class Att extends Thread {
	public function __construct($arg1){
		$this->arg1 = $arg1;
	}

	public function run(){
		print($this->arg1);
		
	}

}