<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "DBNAME"; //Reemplazar con los datos de acceso de la base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Control de Estados (SICE)</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #4facfe, #00f2fe);
            color: #333;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        h1 {
            background-color: rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 0;
            color: #fff;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }
                .status-card {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 15px;
            padding: 20px;
            width: 250px;
            text-align: center;
            transition: transform 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Distribuye mejor el contenido */
            height: 200px; /* Altura fija para todas las tarjetas */
        }

        .status-card h2 {
            margin: 0 0 10px;
            font-size: 1.5em;
            min-height: 50px; /* Asegura que todos los nombres de usuario tengan la misma altura */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .status {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            border-radius: 5px;
            font-size: 1.2em;
            font-weight: bold;
            color: #fff;
            min-height: 50px; /* Asegura que todos los cuadros de estado sean iguales */
        }

        .available {
            background-color: #28a745;
        }

        .not-available {
            background-color: #dc3545;
        }
        footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #fff;
            background-color: rgba(0, 0, 0, 0.1);
            padding: 10px;
        }
    </style>
</head>
<body>
    <h1>Sistema de Control de Estados (SICE)</h1>
    <div class="container" id="statusContainer">
        <!-- Aquí se insertarán los datos dinámicamente -->
    </div>
    <footer>
        &copy; <?php echo date('Y'); ?> Sistema de Control de Estados (SICE). | &copy By: Jesus David Suarez | Todos los derechos reservados.
    </footer>

    <script>
        async function fetchData() {
            try {
                let response = await fetch('data.php');
                let sensores = await response.json();
                
                let container = document.getElementById('statusContainer');
                container.innerHTML = ''; // Limpiar antes de actualizar

                sensores.forEach(sensor => {
                    let card = document.createElement('div');
                    card.classList.add('status-card');

                    let usuario = document.createElement('h2');
                    usuario.textContent = sensor.Usuario;

                    let estado = document.createElement('div');
                    estado.classList.add('status', sensor.estado == 1 ? 'available' : 'not-available');
                    estado.textContent = sensor.estado == 1 ? 'Disponible' : 'No Disponible';

                    let fecha = document.createElement('p');
                    fecha.innerHTML = `<strong>Última Actualización:</strong><br>${sensor.fecha_hora}`;

                    card.appendChild(usuario);
                    card.appendChild(estado);
                    card.appendChild(fecha);
                    container.appendChild(card);
                });

            } catch (error) {
                console.error("Error al obtener datos:", error);
            }
        }

        setInterval(fetchData, 1000); // Actualizar cada segundo
        fetchData(); // Llamar una vez al inicio
    </script>
</body>
</html>
