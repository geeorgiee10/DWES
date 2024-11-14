<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background-color: lightgray;
        }
        h1 {
            margin-bottom: 2em;
        }
        #visitas {
            background-color: blue;
            color: white;
            width: 35em;
            height: 25em;
            margin-top: 1em;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <h1>CONTROL VISITAS PAGINA CON COOKIES</h1>

    <form method="POST">
        <button type="submit" name="borrar_cookie">Borrar cookie</button>
        <button type="submit" name="recargar">Recargar página</button>
    </form>

    <div id="visitas">
        <?php 
        $cookie = "visitas";

        

        if (isset($_POST['borrar_cookie'])) {
            setcookie($cookie, "", time() - 3600, "/");
            exit();
        }

        if (!isset($_POST['recargar'])) {
            if (isset($_COOKIE[$cookie])) {
                $visitas = json_decode($_COOKIE[$cookie], true);
            } 
            else {
                $visitas = [];
            }

            $numero_visitas = count($visitas) + 1;
            $visitas[] = date('l, d F Y H:i:s');

            setcookie($cookie, json_encode($visitas), time() + (86400 * 30), "/");
        } else {
            $visitas = isset($_COOKIE[$cookie]) ? json_decode($_COOKIE[$cookie], true) : [];
            header("Location: " . $_SERVER['PHP_SELF']);
        }

        
        echo "<p>Usted ha visitado esta página: $numero_visitas veces</p>";

        if (!empty($visitas)) {
            echo "Las últimas veces que nos visitó fueron en: "; 
            
            $ultimas = array_slice($visitas, -6);

            foreach (array_reverse($ultimas) as $visita) {
                echo "<p>" . htmlspecialchars($visita) . "</p>";
            }
            
        } else {
            echo "<p>No hay visitas registradas.</p>";
        }
        ?>   
    </div>
</body>
</html>
