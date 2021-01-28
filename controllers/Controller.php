<?php

class controller
{
    
public static function Redirect(string $url){
	   header("Location: ".$url."");
         exit();
	}
    
public function valid($GET=null,string $msg){
    
    if(!empty($_GET['valid'])){
            if($_GET['valid']==1){   
                return $msg;
            }
    }
        else 
            return false;
    }

public function notAdmin($droits){
    if($droits != 1337){
$droits = array();
session_destroy();
header("Location: connexion.php");
    }
}
 
public function alreadyConnect(){
    if(isset($_SESSION['login'])){
        header('location:deconnexion.php');
    }
}
    
public function notConnect(){
    if (!isset($_SESSION['login'])) {
        header('location:connexion.php');
    }
}


    
    
}