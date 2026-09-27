<?php
$_SERVER['HTTP_HOST'] = 'localhost';
require_once 'vendor/autoload.php';
require_once 'config/bootstrap.php';
use Cake\Datasource\ConnectionManager;

$db = ConnectionManager::get('default');

$partner_id = 58; // STAR HIIT partner id

// 1. If filtering active = '1'
$tActive = $db->execute("SELECT id, name FROM users WHERE user_type = 4 AND partner_id = ? AND active = '1'", [$partner_id])->fetchAll('assoc');
echo "Active trainers for partner 58: " . count($tActive) . "\n";
print_r($tActive);

// 2. If NOT filtering active
$tAll = $db->execute("SELECT id, name FROM users WHERE user_type = 4 AND partner_id = ?", [$partner_id])->fetchAll('assoc');
echo "\nAll trainers for partner 58: " . count($tAll) . "\n";
print_r($tAll);
