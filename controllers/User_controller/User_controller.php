<?php
require_once('controllers/Controller.php');
require_once'models/User_model/User_model.php';
class usercontroller extends controller
{
    private $login;
    private $model;
    private $password_hash;
    private $password;
    private $controller;
    private $id_user;
    
    public function __construct(){
        $this->model = new usermodel();
        $this->controller = new controller();
    }
    
    //ok//////
    public function verifGetId(){
    if(empty($_GET['idbutton'])){
        header('location:admin.php');
    }
    if(isset($_GET['idbutton'])){
        $this->id_user = intval($_GET['idbutton']);
        return $this->id_user;
    }
}
    //form suppre user okk///
public function checkFormDeleteUser(){
    if(isset($_POST['submitsuppr'])){
    if(isset($_POST['select'])){
    if($_POST['select']==2){
        return $error = "<p class='alert alert-warning'>Oh quelle confiance ca essaie tout sorte de choses merci beaucoup c'est trop d'honneur</p>";
    }
    if(empty($_POST['select'])){       
    return $error = "<p class='alert alert-danger'>Remplit bien tous les champs</p>";
            }
        if($_POST['select']==1){   
    $this->model->deleteuser($this->id_user);
    $this->controller->Redirect("admin.php?valid=1");
            }
        }
    }
}
///////ok/////
public function checkFormUp(){
    if(isset($_POST['submitdroit'])){
        if(empty($_POST['select'])){       
    return $error = "<p class='alert alert-danger'>Remplit bien tous les champs</p>";
        }
            if($_POST['select']==1 ||   $_POST['select']==42){
            $id_droits = $_POST['select'];
        $this->model->updatedroit($id_droits, $this->id_user);
        $this->controller->Redirect("admin.php?valid=1");
        }
    }    
}
    
public function checkFormUpdate(){
    if(isset($_POST['submit'])){
 	  if (empty($_POST['login']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['password_conf'])) {
        return $error = "<p class='alert alert-danger'>Remplit bien tous les champs</p>";
        }
$login = htmlspecialchars($_POST['login']);
      if ($this->model->exists($login)===-1) {
      	return $error = "<p class='alert alert-danger'>Login deja pris</p>";
            }
$email = htmlspecialchars($_POST['email']);
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  return $error = "<p class='alert alert-danger'>Saisissez un email valide</p>";
}
$password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
$password = htmlspecialchars($_POST['password_conf']);
if(password_verify($password, $password_hash) === false){
return $error = "<p class='alert alert-danger'>mot de passe non identique</p>"; 
        }
    else{
$this->model->updateuser($login, $password_hash, $email, $this->id_user);
$this->controller->Redirect("admin.php?valid=1");
        }
    }
}
    //traitement form inscription//ok/
public function formSignin(){
        if(isset($_POST['submit'])){
 	if (empty($_POST['login']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['password_conf'])) {
        $error = "<p class='alert alert-danger'>Remplit bien tous les champs</p>";
 	return $error;
 }
$email = htmlspecialchars($_POST['email']);
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  return $error = "<p class='alert alert-danger'>Saisissez un email valide</p>";
}
$login = htmlspecialchars($_POST['login']);
    if($this->model->exists($login)===-1){
        return $error="<p class='alert alert-danger'>Login deja pris</p>"; 
        }
$password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
$password = htmlspecialchars($_POST['password_conf']);
        if(password_verify($password, $password_hash) === false){
            return $error = "<p class='alert alert-danger'>mot de passe non identique</p>"; 
        }
 else{
    $id_droits = 1;
$this->model->insert($login, $email, $password_hash, $id_droits);
$this->controller->Redirect("connexion.php?valid=1");
        }     
    }
}
    
//    traitement form connexion
//ok///connexion
public function checkFormSign(){
if(isset($_POST['submit'])){
    if(empty($_POST['logconnect']) || empty($_POST['passconnect'])){
        return $error = "<p class='alert alert-danger'>Champs vide</p>";
    }
    $this->login = htmlspecialchars($_POST['logconnect']);
    if($this->model->exists($this->login)===1){
        return $error = "<p class='alert alert-danger'>Login invalide</p>"; 
    }
$this->password_hash = $this->model->selectPassHash($this->login);
$this->password = htmlspecialchars($_POST['passconnect']);
    if(password_verify($this->password, $this->password_hash) === false){
            return $error = "<p class='alert alert-danger'>mot de passe non identique</p>"; 
    }
    else{
            $this->model->selectUser($this->login);
            $_SESSION['pass']= $this->password;
            $this->controller->Redirect('index.php');
        }
    }
}
    //traitement form profil ok//
public function checkPostProfil(){
    if(isset($_POST['submit'])){
 	  if (empty($_POST['login']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['password_conf'])) {
        return $error = "<p class='alert alert-danger'>Remplit bien tous les champs</p>";
        }
$login = htmlspecialchars($_POST['login']);
      if ($this->model->exists($login)===-1) {
      	return $error = "<p class='alert alert-danger'>Login deja pris</p>";
            }
$email = htmlspecialchars($_POST['email']);
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  return $error = "<p class='alert alert-danger'>Saisissez un email valide</p>";
}
$password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
$password = htmlspecialchars($_POST['password_conf']);
if(password_verify($password, $password_hash) === false){
return $error = "<p class='alert alert-danger'>mot de passe non identique</p>"; 
        }
    else{
        $id = $_SESSION['id'];
      	$this->model->update($login, $password_hash, $email, $password, $id);
      	$this->controller->Redirect("profil.php?valid=1");
        }
    }
}
    //ok admin
public function selectAllUser(){
        return $user = $this->model->selectalluser();
}
//ok///
public function selectUser(){
    return $user = $this->model->selectid($this->id_user);

    }     
}