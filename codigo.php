<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codi PHP</title>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/default.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            padding: 50px;
            margin: 0;
        }
        pre {
            background: #2c3e50;
            padding: 20px;
            border-radius: 10px;
            color: #ecf0f1;
            font-size: 1.1em;
            overflow-x: auto;
        }
        .home-button {
            background-color: #3498db;
            color: white;
            padding: 12px 20px;
            font-size: 1.1em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
        .home-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

    <h1>Codi PHP</h1>
    <pre><code class="php">
&lt;?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $operand1 = $_POST['operand1'];
    $operand2 = $_POST['operand2'];
    $operand3 = isset($_POST['operand3']) ? $_POST['operand3'] : '';

    if ($operand1 === '' || $operand2 === '') {
        echo "&lt;p class='result'&gt;Els operands 1 i 2 són obligatoris!&lt;/p&gt;";
    } else {
        $suma = $operand1 . '+' . $operand2 . '+' . $operand3;
        $es_numero = is_numeric($operand1) && is_numeric($operand2) && ($operand3 === '' || is_numeric($operand3));

        if ($es_numero) {
            $resultado = $operand1 + $operand2 + ($operand3 !== '' ? $operand3 : 0);
        } else {
            $resultado = $operand1 . $operand2 . $operand3;
        }

        $otro_user = null;

        if (isset($_SESSION['sumas'][$suma])) {
            $otro_user = $_SESSION['sumas'][$suma];
        } else {
            $_SESSION['sumas'][$suma] = $username;
        }

        echo "&lt;p class='result'&gt;Resultat: $resultado&lt;/p&gt;";

        if ($anterior_user && $anterior_user !== $username) {
            echo "&lt;p class='result' style='color:red'&gt;Aquesta operació ja va ser realitzada per: $anterior_user&lt;/p&gt;";
        }
    }
}
?&gt;
    </code></pre>

    <a href="index.php" class="home-button">Tornar a l'inici</a>
    <a href="calculadora.php" class="home-button">Calculadora</a>

    <script>hljs.highlightAll();</script>
</body>
</html>
