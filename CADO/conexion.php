<?php 
 class cado{   
      function conectar(){
	   try {
	    $db = new PDO('mysql:host=localhost;dbname=db_dialisis2','root','root');
		 return $db;
		 }catch (PDOException $e) {
	       echo $e->getMessage();
          }
	  }
	  function ejecutar($isql){
	     $ejecutar=$this->conectar()->prepare($isql);
		 $ejecutar->execute();
		 return $ejecutar;
	  }  
   }
?>