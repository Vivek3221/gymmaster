<?php
$pdo = new PDO('mysql:host=localhost;dbname=gymmaster', 'root', '');

echo "--- PLAN SUBSCRIBERS COLUMNS ---\n";
$stmt = $pdo->query('DESCRIBE plan_subscribers');
while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $r['Field'] . " (" . $r['Type'] . ") Default: " . var_export($r['Default'], true) . "\n";
}

echo "\n--- PAYMENTS COLUMNS ---\n";
$stmt = $pdo->query('DESCRIBE payments');
while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $r['Field'] . " (" . $r['Type'] . ") Default: " . var_export($r['Default'], true) . "\n";
}

echo "\n--- RECENT PAYMENTS ---\n";
$stmt = $pdo->query('SELECT p.*, ps.collection_type FROM payments p LEFT JOIN plan_subscribers ps ON p.plan_subscriber_id = ps.id ORDER BY p.id DESC LIMIT 10');
while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
    print_r($r);
}

echo "\n--- RECENT PLAN SUBSCRIBERS ---\n";
$stmt = $pdo->query('SELECT * FROM plan_subscribers ORDER BY id DESC LIMIT 10');
while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
    print_r($r);
}
