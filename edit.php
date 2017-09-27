<?php
require_once 'init.php';
// resgata os valores do formulário
$name = isset($_POST['name']) ? $_POST['name'] : null;
$color = isset($_POST['color']) ? $_POST['color'] : null;
$price = isset($_POST['price']) ? $_POST['price'] : null;
$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : null;
$startDate = isset($_POST['startDate']) ? $_POST['startDate'] : null;
$id = isset($_POST['id']) ? $_POST['id'] : null;
// validação (bem simples, mais uma vez)
if (empty($name) || empty($color) || empty($price) || empty($quantity)|| empty($startDate))
{
    echo "Volte e preencha todos os campos";    
    exit;
}
// a data vem no formato dd/mm/YYYY
// então precisamos converter para YYYY-mm-dd
// atualiza o banco
$PDO = db_connect();
$sql = "UPDATE products SET name = :name, color = :color,"
        . " price = :price, quantity = :quantity, startDate = :startDate WHERE id = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':color', $color);
$stmt->bindParam(':price', $price);
$stmt->bindParam(':quantity', $quantity);
$stmt->bindParam(':startDate', $startDate);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
if ($stmt->execute())
{
    header('Location: index.php');
}
else
{
    echo "Erro ao alterar";
    print_r($stmt->errorInfo());
}