<?php
$pdo = new PDO('mysql:host=localhost;dbname=gymmaster', 'root', '');
$stmt = $pdo->query("SELECT id, name, email, password FROM users WHERE id IN (546, 555, 556)");
while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "ID: " . $r['id'] . " | Name: " . $r['name'] . " | Password len: " . strlen($r['password']) . "\n";
}
