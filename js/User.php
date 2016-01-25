<?php
	class User {
		private $uID;
		private $uFName;
		private $uLName;
		private $uAdmin;
		
		public function __construct() {
			if(func_num_args() != 4) {
				throw new Exception("There was a problem creating the user for the session.");
			}
			$this->uID = func_get_arg(0);
			$this->uFName = func_get_arg(1);
			$this->uLName = func_get_arg(2);
			$this->uAdmin = func_get_arg(3);
		}
	}
?>