<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultes SQL</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .query-section {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .query-section h2 {
            color: #0056b3;
            font-size: 1.5em;
            margin-top: 0;
        }

        .query-section p {
            color: #333;
            font-size: 1em;
            line-height: 1.6em;
        }

        .query-section code {
            display: block;
            background-color: #f9f9f9;
            border: 1px solid #e1e1e1;
            padding: 10px;
            border-radius: 4px;
            font-family: Consolas, "Courier New", Courier, monospace;
            color: #d6336c;
            white-space: pre-wrap;
        }

        .button-container {
            text-align: center;
            margin-top: 30px;
        }

        .button-container a {
            background-color: #3498db;
            color: white;
            padding: 12px 20px;
            font-size: 1.1em;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            margin: 10px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .button-container a:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>

    <h1>Consultes SQL</h1>

    <div class="query-section">
        <h2>1. Obtenir els primers 15 clients ordenats pel camp idClient de forma ascendent</h2>
        <p>Aquesta consulta obté els primers 15 clients ordenats per l'identificador del client (idClient) en ordre ascendent:</p>
        <code>
            SELECT *<br>
            FROM clients<br>
            ORDER BY idClient<br>
            LIMIT 15;
        </code>
    </div>

    <div class="query-section">
        <h2>2. Obtenir la suma de la baseImponible i el nombre de factures del client amb CIF A7789118</h2>
        <p>Aquesta consulta calcula la suma de la base imposable i el nombre de factures del client amb CIF A7789118:</p>
        <code>
            SELECT SUM(f.baseImponible) AS sumaBaseImponible, COUNT(f.idFactura) AS numeroFactures<br>
            FROM factures f<br>
            JOIN clients c ON f.idClient = c.idClient<br>
            WHERE c.CIF = 'A7789118';
        </code>
    </div>

    <div class="query-section">
        <h2>3. Obtenir totes les factures en les que apareix el Producte amb idProducte = 35</h2>
        <p>Aquesta consulta obté totes les factures que contenen el producte amb l'identificador 35:</p>
        <code>
            SELECT DISTINCT f.*<br>
            FROM factures f<br>
            JOIN linies_factura lf ON f.idFactura = lf.idFactura<br>
            WHERE lf.idProducte = 35;
        </code>
    </div>

    <div class="query-section">
        <h2>4. Eliminar totes les Factures dels clients amb CIF que comenci amb ‘C’ i que tinguin una baseImponible més gran de 1000€</h2>
        <p>Aquesta consulta elimina totes les factures dels clients amb un CIF que comenci amb la lletra 'C' i que tinguin una base imposable superior a 1000€:</p>
        <code>
            DELETE f.*<br>
            FROM factures f<br>
            JOIN clients c ON f.idClient = c.idClient<br>
            WHERE c.CIF LIKE 'C%' AND f.baseImponible &gt; 1000;
        </code>
    </div>

    <div class="query-section">
        <h2>5. Actualitzar l’estatPagament de totes les Factures a ‘Pagat’ per a factures amb productes amb un preuVenda superior al preuCost</h2>
        <p>Aquesta consulta actualitza l'estat de pagament a 'Pagat' per a totes les factures que contenen productes amb un preu de venda superior al preu de cost:</p>
        <code>
            UPDATE factures f<br>
            JOIN linies_factura lf ON f.idFactura = lf.idFactura<br>
            JOIN productes p ON lf.idProducte = p.idProducte<br>
            SET f.estatPagamanet = 'Pagat'<br>
            WHERE p.preuVenda &gt; p.preuCost;
        </code>
    </div>

    <div class="button-container">
        <a href="index.php">Tornar a l'inici</a>
        <a href="calculadora.php">Calculadora</a>
    </div>

</body>
</html>
