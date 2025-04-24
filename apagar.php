<?php
require('conexaobd.php');

$sql = "DELETE * FROM clientes WHERE cpf = :cpf";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':cpf', $cpfUsuario, PDO::PARAM_STR);
$stmt->execute();

?>