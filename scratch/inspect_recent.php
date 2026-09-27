<?php
require 'config/bootstrap.php';
use Cake\Datasource\ConnectionManager;
$conn = ConnectionManager::get('default');

echo "--- RECENT PAYMENTS ---\n";
$payments = $conn->execute('SELECT p.id, p.user_id, p.plan_subscriber_id, p.amount, p.created, ps.collection_type, ps.plan_id, ps.name, ps.amount as ps_amount FROM payments p LEFT JOIN plan_subscribers ps ON p.plan_subscriber_id = ps.id ORDER BY p.id DESC LIMIT 10')->fetchAll('assoc');
print_r($payments);

echo "--- RECENT PLAN SUBSCRIBERS ---\n";
$subs = $conn->execute('SELECT id, user_id, plan_id, name, amount, paid_amount, collection_type, created FROM plan_subscribers ORDER BY id DESC LIMIT 10')->fetchAll('assoc');
print_r($subs);
