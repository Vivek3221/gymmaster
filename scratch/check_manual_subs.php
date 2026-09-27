<?php
$pdo = new PDO('mysql:host=localhost;dbname=gymmaster', 'root', '');
$stmt = $pdo->query("SELECT id, user_id, plan_name, fee, collection_type, created FROM plan_subscribers WHERE collection_type = 'manual'");
echo "MANUAL PLAN SUBSCRIBERS:\n";
while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
    print_r($r);
}

echo "\nCOUNT BY COLLECTION TYPE:\n";
$stmt = $pdo->query("SELECT collection_type, COUNT(*) as cnt FROM plan_subscribers GROUP BY collection_type");
while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
    print_r($r);
}
