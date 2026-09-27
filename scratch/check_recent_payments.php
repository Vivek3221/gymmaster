<?php
$_SERVER['HTTP_HOST'] = 'localhost';
require_once 'c:/wamp64/www/gymmaster/vendor/autoload.php';
require_once 'c:/wamp64/www/gymmaster/config/bootstrap.php';
use Cake\Datasource\ConnectionManager;

$db = ConnectionManager::get('default');

$payments = $db->execute("SELECT id, user_id, amount, plan_subscriber_id, payment_date, mode_ofpay, discount_percent, discount_amount, discount_reason, created FROM payments ORDER BY id DESC LIMIT 10")->fetchAll('assoc');
echo "--- LATEST PAYMENTS ---\n";
foreach ($payments as $p) {
    echo "Payment ID: {$p['id']} | User ID: {$p['user_id']} | Amount: {$p['amount']} | PS ID: {$p['plan_subscriber_id']} | Date: {$p['payment_date']} | DiscAmt: {$p['discount_amount']} | Created: {$p['created']}\n";
}

$subs = $db->execute("SELECT id, user_id, plan_name, fee, collection_type, payment_due_date, created FROM plan_subscribers ORDER BY id DESC LIMIT 10")->fetchAll('assoc');
echo "\n--- LATEST PLAN SUBSCRIBERS ---\n";
foreach ($subs as $s) {
    echo "PS ID: {$s['id']} | User ID: {$s['user_id']} | Plan: {$s['plan_name']} | Fee: {$s['fee']} | ColType: {$s['collection_type']} | DueDate: {$s['payment_due_date']} | Created: {$s['created']}\n";
}
