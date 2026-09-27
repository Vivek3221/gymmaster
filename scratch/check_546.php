<?php
$pdo = new PDO('mysql:host=localhost;dbname=gymmaster', 'root', '');
$stmt = $pdo->query('SELECT id, user_id, plan_name, fee, collection_type, created FROM plan_subscribers WHERE user_id = 546');
while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
    print_r($r);
}

echo "\nALL PAYMENTS FOR 546:\n";
$stmt = $pdo->query('SELECT p.id, p.user_id, p.plan_subscriber_id, p.amount, p.payment_date, p.created, ps.collection_type FROM payments p LEFT JOIN plan_subscribers ps ON p.plan_subscriber_id = ps.id WHERE p.user_id = 546 ORDER BY p.id DESC');
while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
    print_r($r);
}
