<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            text-align: center;
            padding: 50px;
            margin: 0;
        }
        h1 {
            color: #2c3e50;
            font-size: 2.5em;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        form {
            display: inline-block;
            text-align: left;
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #34495e;
        }
        input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            font-size: 1em;
            border-radius: 5px;
            border: 1px solid #bdc3c7;
            margin-bottom: 15px;
            outline: none;
            transition: border 0.3s ease;
        }
        input[type="text"]:focus {
            border-color: #3498db;
        }
        input[type="submit"], .home-button {
            background-color: #3498db;
            color: white;
            padding: 12px 20px;
            font-size: 1.1em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            width: 100%;
            text-align: center;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
        .home-button {
            width: 30%;
        }
        input[type="submit"]:hover, .home-button:hover {
            background-color: #2980b9;
        }
        .result {
            margin-top: 25px;
            font-size: 1.6em;
            color: #2c3e50;
        }
        .home-button-container {
            margin-top: 30px;
        }
    </style>
</head>
<body>

    <h1>Calculadora</h1>
    <form method="POST">
        <label for="username">Nom Usuari:</label>
        <input type="text" id="username" name="username" required>

        <label for="operand1">Operand 1:</label>
        <input type="text" id="operand1" name="operand1"> <!-- Se podria poner require pero no se mostraria el mensaje -->

        <label for="operand2">Operand 2:</label>
        <input type="text" id="operand2" name="operand2">  <!-- Se podria poner require pero no se mostraria el mensaje -->

        <label for="operand3">Operand 3:</label>
        <input type="text" id="operand3" name="operand3">

        <input type="submit" value="Calcular">
    </form>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $operand1 = $_POST['operand1'];
        $operand2 = $_POST['operand2'];
        $operand3 = isset($_POST['operand3']) ? $_POST['operand3'] : '';

        if ($operand1 === '' || $operand2 === '') {
            echo "<p class='result'>Els operands 1 i 2 són obligatoris!</p>";
        } else{

            $suma = $operand1 . '+' . $operand2 . '+' . $operand3;
            $es_numero = is_numeric($operand1) && is_numeric($operand2) && ($operand3 === '' || is_numeric($operand3));

            if ($es_numero) {
                $resultado = $operand1 + $operand2 + ($operand3 !== '' ? $operand3 : 0);
            } else {
                $resultado = $operand1 . $operand2 . $operand3;
            }

            // guardo operacions realitzades per primer cop
            $otro_user = null;

            if (isset($_SESSION['sumas'][$suma])) {
                $otro_user = $_SESSION['sumas'][$suma];
            } else {
                $_SESSION['sumas'][$suma] = $username;
            }

            echo "<p class='result'>Resultat: $resultado</p>";

            if ($otro_user && $otro_user !== $username) {
                echo "<p class='result' style='color:red'>Error: Aquesta operació ja va ser realitzada per un altre usuari (Usuari: $otro_user).</p>";
            }
        }
    }
    ?>

    <div class="home-button-container">
        <a href="index.php" class="home-button">Tornar a l'inici</a>
        <a href="consultes.php" class="home-button">Consultes SQL</a>
        <a href="codigo.php" class="home-button">Veure Codi PHP</a>
    </div>

</body>
</html>
