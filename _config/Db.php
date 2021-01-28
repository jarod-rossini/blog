<?php
//probleme de trop de connexion recurrentes peut tres bien arriver 
	//solutioné Grace a Singleton
class db{
			//DESIGN PATERN SINGLETON 
	private static $instance = null;
//en passant une fois le self::instance ne reste plus null ce qui fais que la connexion a la bdd est reutiliser et pas dupliqué on renvoit la meme connexion vue quil n'est plus null la deuxieme fois ou il passe il va direct recup le return
public static function getPdo(): PDO
{
	if (self::$instance === null) {
	self::$instance = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);
}
	return self::$instance;
}
}