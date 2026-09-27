<?php
$pdo = new PDO('mysql:host=localhost;dbname=gymmaster', 'root', '');

// Check user 546 and 556
$stmt = $pdo->query("SELECT id, name, email, user_type, partner_id FROM users WHERE id IN (546, 555, 556)");
while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
    print_r($r);
}

// Check logged in users (e.g. ad1234@yopmail.com, etc.)
$stmt = $pdo->query("SELECT id, name, email, user_type, partner_id FROM users WHERE email LIKE '%yopmail%' OR email LIKE '%gmail%' LIMIT 10");
while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
    print_r($r);
}
