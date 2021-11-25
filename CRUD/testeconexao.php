<?php
try{
  $pdo = new PDO("mysql:dbname=crudpdo;host=localhost","root","");

}catch (PDOException $e){
  echo "Erro no banco de dados: ".$e->getMessage();

}catch (Exception $e)
{
  echo "Erro generico: ".$e->getMessage();;

}


//---------------------------INSERT-----------------------------------------------------------//

//$pdo->query("INSERT INTO pessoa(nome, telefone, email) VALUES('Emanuel','0000000','emanuel@gmail.com')");


//----------------------------DELETE / UPDATE---------------------------------------------------------------//

//$res = $pdo->query("DELETE FROM pessoa WHERE id = '15'");

//$res = $pdo->query("UPDATE pessoa SET email = 'emanuel2@gmail.com' WHERE id = '16'");

//---------------------------SELECT------------------------------------------------------------------//

$cmd = $pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
$cmd->bindValue(":id", 16);
$cmd->execute();
$resultado = $cmd->fetch(PDO::FETCH_ASSOC);

foreach ($resultado as  $key => $value){
  echo $key. ": ".$value."<br>";
}
