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
