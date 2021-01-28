<?php
require_once('_config/Db.php');
class model{
    protected $pdo;
    
    public function __construct(){
		$this->pdo = \db::getPdo();
	}
    
}