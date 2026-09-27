<?php
$pdo = new PDO('mysql:host=localhost;dbname=gymmaster', 'root', '');
$stmt = $pdo->query('DESCRIBE users');
while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
    if (strpos($r['Field'], 'collection') !== false) {
        echo "Found: " . $r['Field'] . "\n";
    }
}
