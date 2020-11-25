<?php
session_start();
include "funcions.php";
$_SESSION["clave"] = generar_string();

require 'stripe/init.php';

\Stripe\Stripe::setApiKey('sk_test_51HotLaFKOcyWVH65WipOLA2n1GOXv92kPCVvDIx0wzrSpU6YOVd9g0nWoTidG7OnN3uwgart3mt1Ddo7hd5yjCtN00bD6B24un');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'https://dawjavi.insjoaquimmir.cat';

$checkout_session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card'],
  'line_items' => [[
    'price_data' => [
      'currency' => 'eur',
      'unit_amount' => number_format($_SESSION["precios"], 2, "", ""),
      'product_data' => [
        'name' => 'Compra en Reconfirmo Web',
        'images' => ["https://i.imgur.com/dvpqHBi.jpg"],
      ],
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/kchafla/M07/UF1/Activitat%207/ExerciciAceptat.php?clave=' . $_SESSION["clave"],
  'cancel_url' => $YOUR_DOMAIN . '/kchafla/M07/UF1/Activitat%207/ExerciciDenegat.php',
]);

echo json_encode(['id' => $checkout_session->id]);