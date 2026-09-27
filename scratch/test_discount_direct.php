<?php
$pdo = new PDO('mysql:host=localhost;dbname=gymmaster', 'root', '');

// Get PS 425
$stmt = $pdo->prepare("SELECT id, user_id, fee FROM plan_subscribers WHERE id = 425");
$stmt->execute();
$ps = $stmt->fetch(PDO::FETCH_ASSOC);

// Get Payments for PS 425
$stmt = $pdo->prepare("SELECT id, amount, discount_amount, is_deleted FROM payments WHERE plan_subscriber_id = 425");
$stmt->execute();
$payments = $stmt->fetchAll(PDO::FETCH_ASSOC);

$paid = 0;
$discount = 0;
foreach ($payments as $p) {
    if ($p['is_deleted'] == 0) {
        $paid += (float)$p['amount'];
        $discount += (float)$p['discount_amount'];
    }
}

$remaining = max(0, (float)$ps['fee'] - $discount - $paid);

echo "PS ID: " . $ps['id'] . "\n";
echo "Total Plan Fee: " . $ps['fee'] . "\n";
echo "Total Discount Given: " . $discount . "\n";
echo "Total Amount Paid: " . $paid . "\n";
echo "Calculated Remaining Due: " . $remaining . "\n";
echo "Formula: {$ps['fee']} - {$discount} - {$paid} = {$remaining}\n";
