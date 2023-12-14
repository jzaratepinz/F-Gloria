<?php
include 'conexion.php';

// Función para agregar un empleado
function agregarEmpleado($Cedula,$Nombre1,$Nombre2, $Apellido1, $Apellido2,$Cargo) {
    global $conn;
    $query = "INSERT INTO empleados (Cedula,Nombre1,Nombre2, Apellido1, Apellido2,Cargo) VALUES (?, ?, ?)";
    $params = array($Cedula,$Nombre1,$Nombre2, $Apellido1, $Apellido1,$Cargo);
    $stmt = sqlsrv_query($conn, $query, $params);
    return $stmt;
}

// Función para eliminar un empleado
function eliminarEmpleado($id) {
    global $conn;
    $query = "DELETE FROM empleados WHERE id = ?";
    $params = array($id);
    $stmt = sqlsrv_query($conn, $query, $params);
    return $stmt;
}

// Función para modificar un empleado
function modificarEmpleado($id,$Cedula,$Nombre1,$Nombre2, $Apellido1, $Apellido2,$Cargo) {
    global $conn;
    $query = "UPDATE empleados SET Cedula = ?,Nombre1 = ?, Nombre2 = ?, Apellido1 = ?, Apellido2 = ?,Cargo = ? WHERE id = ?";
    $params = array($Cedula,$Nombre1,$Nombre2, $Apellido1, $Apellido2,$Cargo,$id);
    $stmt = sqlsrv_query($conn, $query, $params);
    return $stmt;
}

// Función para consultar empleados
function consultarEmpleados() {
    global $conn;
    $query = "SELECT * FROM empleados";
    $stmt = sqlsrv_query($conn, $query);
    $empleados = array();
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $empleados[] = $row;
    }
    return $empleados;
}

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["agregar"])) {
        $Cedula = $_POST["Cedula"];
        $Nombre1 = $_POST["Nombre1"];
        $Nombre2 = $_POST["Nombre2"];
        $Apellido1 = $_POST["Apellido1"];
        $Apellido2 = $_POST["Apellido2"];
        $Cargo = $_POST["Cargo"];
        agregarEmpleado($Cedula,$Nombre1,$Nombre2, $Apellido1, $Apellido2,$Cargo);
    } elseif (isset($_POST["eliminar"])) {
        $id = $_POST["id"];
        eliminarEmpleado($id);
    } elseif (isset($_POST["modificar"])) {
        $id = $_POST["id"];
        $Cedula = $_POST["Cedula"];
        $Nombre1 = $_POST["Nombre1"];
        $Nombre2 = $_POST["Nombre2"];
        $Apellido1 = $_POST["Apellido1"];
        $Apellido2 = $_POST["Apellido2"];
        $Cargo = $_POST["Cargo"];
        modificarEmpleado($id, $Cedula,$Nombre1,$Nombre2, $Apellido1, $Apellido2,$Cargo);
    }
}

// Obtener la lista de empleados
$empleados = consultarEmpleados();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Empleados Gloria</title>
</head>
<body>
    <h1>Formulario Empleados</h1>

    <!-- Formulario para agregar empleado -->
    <form method="post">
        <label for="Cedula">Cedula:</label>
        <input type="number" name="Cedula" required>
        <label for="Nombre1">Nombre1:</label>
        <input type="text" name="Nombre1" required>
        <label for="Nombre2">Nombre2:</label>
        <input type="text" name="Nombre2" required>
        <label for="Apellido1">Apellido1:</label>
        <input type="number" name="Apellido1" step="0.01" required>
        <label for="Apellido2">Apellido2:</label>
        <input type="number" name="Apellido2" step="0.01" required>
        <label for="Cargo">Cargo:</label>
        <input type="text" name="Cargo" required>
        <button type="submit" name="agregar">Agregar Empleado</button>
    </form>

    <!-- Formulario para eliminar/modificar empleado -->
    <h2>Eliminar/Modificar Empleado</h2>
    <form method="post">
        <label for="id">ID Empleado:</label>
        <input type="number" name="id" required>
        <button type="submit" name="eliminar">Eliminar</button>
        <button type="submit" name="modificar">Modificar</button>
    </form>

    <!-- Lista de empleados -->
    <h2>Lista de Empleados</h2>
    <ul>
        <?php foreach ($empleados as $empleado): ?>
            <li><?= $empleado['id'] ?> - <?= $empleado['Nombre1'] ?> - <?= $empleado['Apellido1'] ?> - <?= $empleado['Cargo'] ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
