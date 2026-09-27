<?php
$pdo = new PDO('mysql:host=localhost;dbname=gymmaster', 'root', '');
$stmt = $pdo->query("SELECT ps.*, u.name as user_name FROM plan_subscribers ps LEFT JOIN users u ON ps.user_id = u.id WHERE ps.id = 421");
$r = $stmt->fetch(PDO::FETCH_ASSOC);
print_r($r);
