<?php
$pdo = new PDO('mysql:host=localhost;dbname=gymmaster', 'root', '');

// Update payment 460 to plan 423
$pdo->exec("UPDATE payments SET plan_subscriber_id = 423 WHERE id = 460");

echo "Payment 460 updated. Checking payment 460 now:\n";
$stmt = $pdo->query("SELECT p.id, p.user_id, p.plan_subscriber_id, p.amount, p.payment_date, ps.plan_name, ps.collection_type FROM payments p LEFT JOIN plan_subscribers ps ON p.plan_subscriber_id = ps.id WHERE p.id = 460");
print_r($stmt->fetch(PDO::FETCH_ASSOC));
