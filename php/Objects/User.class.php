class User{
	private $uID;
	private $uFName;
	private $uLName;
	private $admin;
	
	public function __construct() {
		if(func_num_args() === 4) {
			$this->uID = func_get_arg(0);
			$this->uFName = func_get_arg(1);
			$this->uLName = func_get_arg(2);
			$this->admin = func_get_arg(3);
		}
	}
	
	public function getID() {
		return $this->uID;
	}
	
	public function getFirstName() {
		return $this->uFName;
	}
	
	public function getLastName() {
		return $this->uLName;
	}
	
	public function getName() {
		return $this->uFName . " " . $this->uLName;
	}
	
	public function getPermission() {
		return $this->admin;
	}
}