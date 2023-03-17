<?php
    include('connection.php');
    $motor = $_GET['motor'];
    $humedad = $_GET['humedad'];

    $mysql = "INSERT INTO `proyecto` (`motor`, `humedad`) VALUES (:motor,:humedad)";

    //bind
    $stmt = $conn->prepare($mysql);
    $stmt->bindParam(':motor', $motor);
    $stmt->bindParam(':humedad', $humedad);

    if ($stmt->execute()){

        echo "guardado correcto";
    }
    else{
        echo "ERROR al guardar";

    }
?>
