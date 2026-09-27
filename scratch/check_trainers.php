<?php
$pdo = new PDO('mysql:host=localhost;dbname=gymmaster', 'root', '');
echo "--- ALL TRAINERS (user_type = 4) ---\n";
$stmt = $pdo->query("SELECT id, name, email, user_type, partner_id, active FROM users WHERE user_type = 4");
while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
    print_r($r);
}

echo "\n--- PARTNERS (user_type = 2) ---\n";
$stmt = $pdo->query("SELECT id, name, email, user_type, partner_id, active FROM users WHERE user_type = 2");
while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
    print_r($r);
}

echo "\n--- FRONT DESK (user_type = 5) ---\n";
$stmt = $pdo->query("SELECT id, name, email, user_type, partner_id, active FROM users WHERE user_type = 5");
while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
    print_r($r);
}
