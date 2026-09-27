<?php
$_SERVER['HTTP_HOST'] = 'localhost';
require_once 'vendor/autoload.php';
require_once 'config/bootstrap.php';
use Cake\ORM\TableRegistry;

$psTable = TableRegistry::get('PlanSubscribers');
$sub = $psTable->get(425, ['contain' => ['Payments']]);

echo "Plan Subscriber 425:\n";
echo "Total Fee: " . $sub->fee . "\n";
echo "Paid Fee: " . $sub->paid_fee . "\n";
echo "Discount Fee: " . $sub->discount_fee . "\n";
echo "Remain Fee (Entity): " . $sub->remain_fee . "\n";

$expected = $sub->fee - $sub->discount_fee - $sub->paid_fee;
echo "Expected Remain Fee: " . $expected . "\n";
if ($sub->remain_fee == $expected) {
    echo "SUCCESS: Discount properly deducted from Remaining Fee!\n";
} else {
    echo "FAILED: Mismatch!\n";
}
