<?php
$pdo = new PDO('mysql:host=localhost;dbname=gymmaster', 'root', '');
echo "--- RECENT 5 PAYMENTS ---\n";
$stmt = $pdo->query('SELECT * FROM payments ORDER BY id DESC LIMIT 5');
while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) { print_r($r); }

echo "--- RECENT 5 PLAN SUBSCRIBERS ---\n";
$stmt = $pdo->query('SELECT * FROM plan_subscribers ORDER BY id DESC LIMIT 5');
while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) { print_r($r); }
