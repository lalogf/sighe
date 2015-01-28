<?php session_start();
     if(!isset($_SESSION['S_user'])){
		header("location:index.php");
		} 
 require_once("CADO/ClaseUsuario.php");
 
 
 function permiso($permiso){
 $ousuario=new Usuarios();
 $user=$_SESSION['S_user'];
	 
		 $verificar=$ousuario->permiso($user,$permiso);
		 $cantidad=$verificar->rowCount();
		 return $cantidad;
		 
 }
 
 
 
 
?>