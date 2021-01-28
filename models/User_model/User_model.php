<?php
require_once('models/Model.php');
class usermodel extends model
{
    protected $pdo;
    //ok
    public function selectalluser(){
    $sql = "SELECT id, login, email, password, id_droits FROM utilisateurs";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    while($user = $stmt->fetchAll(PDO::FETCH_ASSOC)){
        return $user;
    }
}  
    //ok
public function selectid($id_user){
         $sql = ('SELECT id, login, email, password, id_droits FROM utilisateurs WHERE id = :id');
         $stmt = $this->pdo->prepare($sql);
         $stmt->bindValue(':id', $id_user);
         $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
             return $row;
     }
     //ok
 public function selectUser($login){
 	$sql = "SELECT id, login, email, password, id_droits FROM utilisateurs WHERE login = :login";
	$stmt = $this->pdo->prepare($sql);
	$stmt->execute(['login' => $login]);
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
	if(!$user){
		return false;
	}
	else   
			$_SESSION['login'] = $user['login'];
			$_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['droits'] = $user['id_droits']; 
 }
public function exists($login){
	$stmt = $this->pdo->prepare("SELECT login FROM utilisateurs WHERE login = :login ;");
    $stmt->execute(['login' => $login]);
    if($stmt->rowCount() > 0){
        return -1;
    } else 
        return 1;
 }
     
public function selectPassHash($login){
    
    $stmt = $this->pdo->prepare("SELECT password FROM utilisateurs WHERE login = :login ;");
            $stmt->execute(['login' => $login]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if(!$user){
		return false;
	}
     else 
        return $user['password'];
                
            }
    
public function insert($login, $email, $password, $id_droits){
 	       $query = $this->pdo->prepare('INSERT INTO utilisateurs SET login = :login, email = :email, password = :password, id_droits= :id_droits');
	       $query->execute(compact('login', 'email', 'password','id_droits'));
 }

 public function update($login, $password, $email, $password_conf, $id){
 	$sql = "UPDATE utilisateurs SET login=:login, email=:email, password=:password WHERE id=:id";
			$stmt= $this->pdo->prepare($sql);
			$stmt->execute(['login' => $login, 'password' => $password, 'email' => $email, 'id' => $id]);
       		$_SESSION['login'] = $login;
       		$_SESSION['pass'] = $password_conf;
            $_SESSION['email'] = $email;
       		$_SESSION['id'] = $id;
       		return $_SESSION;
    }
    
public function updatedroit($id_droits, $id){
        $sql = "UPDATE utilisateurs SET id_droits =:id_droits WHERE id=:id";
        $stmt= $this->pdo->prepare($sql);
        intval($id_droits);
        $stmt->execute([
            'id_droits' => $id_droits,
            'id' => $id
                       ]);
    }
    
public function deleteuser($id_user){
        $sql = "DELETE FROM utilisateurs WHERE id = :id";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute([
            'id' => $id_user
                       ]);
    }
    
 public function updateuser($login, $password, $email, $id){
 	$sql = "UPDATE utilisateurs SET login =:login, email =:email, password =:password WHERE id =:id";
			$stmt= $this->pdo->prepare($sql);
			$stmt->execute(['login' => $login, 'password' => $password, 'email' => $email, 'id' => $id]);
    }
    
    
}
