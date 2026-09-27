<?php
$pdo = new PDO('mysql:host=localhost;dbname=gymmaster', 'root', '');

// Query plan_subscribers for user 546 as done in addPayment
$stmt = $pdo->query("SELECT id, plan_name, fee, collection_type FROM plan_subscribers WHERE user_id = 546 AND (collection_type != 'manual' OR collection_type IS NULL)");
echo "Plans available in normal add_payment for user 546:\n";
while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
    print_r($r);
}

// Check Payments list query to confirm payment 460 appears
$stmt = $pdo->query("SELECT p.id, p.user_id, p.amount, p.payment_date, ps.plan_name, ps.collection_type 
    FROM payments p 
    LEFT JOIN plan_subscribers ps ON p.plan_subscriber_id = ps.id 
    WHERE p.is_deleted = 0 AND (ps.collection_type != 'manual' OR ps.collection_type IS NULL) 
    ORDER BY p.id DESC LIMIT 5");
echo "\nTop 5 normal payments in Payments index:\n";
while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
    print_r($r);
}
