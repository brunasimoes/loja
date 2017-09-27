<?php
require 'init.php';
// pega o ID da URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
// valida o ID
if (empty($id)) {
    echo "ID para alteração não definido";
    exit;
}
// busca os dados do usuário a ser editado
$PDO = db_connect();
$sql = "SELECT name, color, price, quantity, startDate FROM products WHERE id = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$products = $stmt->fetch(PDO::FETCH_ASSOC);
// se o método fetch() não retornar um array, significa que o ID não corresponde 
// a um usuário válido
if (!is_array($products)) {
    echo "Nenhum usuário encontrado";
    exit;
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Edição de Produtos</title> 
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>

    </head>
    <body>
        <div class="content">
            <div class="container clearfix">
                <h1>Sistema de Cadastro</h1>
                <h2>Edição de Produtos</h2>
                <form action="edit.php" method="post">
                    <label for="name">Nome: </label>
                    <br>
                    <input type="text" name="name" id="name" value="<?php echo $products['name'] ?>">
                    <br><br>
                    <label for="color">Cor: </label>
                    <br>
                    <input type="color" name="color" id="color" value="<?php echo $products['color'] ?>">
                    <br><br>
                    <label for="price">Preço: </label>
                    <br>
                    <input type="number" name="price" id="price" value="<?php echo $products['price'] ?>">
                    <br>
                    <br>
                    <label for="quantity">Quantidade: </label>
                    <br>
                    <input type="number" name="quantity" id="quantity" value="<?php echo $products['quantity'] ?>">
                    <br><br>
                    <label for="startDate">Data da Compra: </label>
                    <br>
                    <input type="date" name="startDate" id="startDate" value="<?php echo dateConvert($products['startDate']) ?>">
                    <br><br>

                    <br>
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <input type="submit" value="Alterar">
                </form>
            </div>
        </div>
        <script src="js/npm.js" type="text/javascript"></script>
        <script src="js/bootstrap.js" type="text/javascript"></script>
    </body>
</html>