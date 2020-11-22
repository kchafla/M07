<?php
session_start();
include "funcions.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Carrito</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_REQUEST["volver"])) {
            header("Location: ExerciciPublic.php");
        }
        if (isset($_REQUEST["sacar"])) {
            sacar_carrito($_REQUEST["id"]);
        }
    }

    if (!isset($_SESSION["user"])) {
        header("Location: ExerciciPublic.php");
    }

    echo "<h2>Hola ".$_SESSION["user"]."!</h2>";
?>
<form method="post">
    <h3>Volver a la pagina principal: <button type="submit" name="volver" value="si">Volver</button></h3>
</form>
<?php
    tabla_productos_carrito();
?>
    <h3>Realizar la compra: <button id="checkout-button">Pagar</button></h3>
</body>

<script type="text/javascript">
    // Create an instance of the Stripe object with your publishable API key
    var stripe = Stripe("pk_test_51HotLaFKOcyWVH65wW073Ux7LyIqipeObRxmbBXUzMxrIhD0go0ZPeSfRg6zkw3ALO5NB5fNC2YuaENo8xSKYQSG00tFyaqaLV");
    var checkoutButton = document.getElementById("checkout-button");
    checkoutButton.addEventListener("click", function () {
    fetch("/kchafla/M07/UF1/Activitat%207/create-session.php", {
        method: "POST",
    })
        .then(function (response) {
        return response.json();
        })
        .then(function (session) {
        return stripe.redirectToCheckout({ sessionId: session.id });
        })
        .then(function (result) {
        // If redirectToCheckout fails due to a browser or network
        // error, you should display the localized error message to your
        // customer using error.message.
        if (result.error) {
            alert(result.error.message);
        }
        })
        .catch(function (error) {
        console.error("Error:", error);
        });
    });
</script>
</html>