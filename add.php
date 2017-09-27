<?php
require_once 'init.php';
// pega os dados do formuário
$name = isset($_POST['name']) ? $_POST['name'] : null;
$color = isset($_POST['color']) ? $_POST['color'] : null;
$price = isset($_POST['price']) ? $_POST['price'] : null;
$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : null;
$startDate = isset($_POST['startDate']) ? $_POST['startDate'] : null;
$id = isset($_POST['id']) ? $_POST['id'] : null;
// validação (bem simples, só pra evitar dados vazios)
if (empty($name) || empty($color) || empty($price) || empty($quantity) || empty($startDate))
{
    echo "Volte e preencha todos os campos";
    exit;
}
// a data vem no formato dd/mm/YYYY
// então precisamos converter para YYYY-mm-dd
$isoDate = dateConvert($startDate);
// insere no banco
$PDO = db_connect();
$sql = "INSERT INTO products(name, color, price, quantity, startDate) VALUES(:name, :color, :price, :quantity, :startDate)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':color', $color);
$stmt->bindParam(':price', $price);
$stmt->bindParam(':quantity',$quantity);
$stmt->bindParam(':startDate', $startDate);
if ($stmt->execute())
{
    header('Location: index.php');
}
else
{
    echo "Erro ao cadastrar";
    print_r($stmt->errorInfo());
}