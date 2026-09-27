<?php
$_SERVER['HTTP_HOST'] = 'localhost';
require_once 'vendor/autoload.php';
require_once 'config/bootstrap.php';
use Cake\Datasource\ConnectionManager;

$db = ConnectionManager::get('default');

$u = $db->execute("SELECT id, name, email, user_type, partner_id FROM users WHERE email LIKE '%makeover%'")->fetchAll('assoc');
echo "LOGGED IN USER CANDIDATES:\n";
print_r($u);

$targetUser = $db->execute("SELECT id, name, email, user_type, partner_id, trainer_userid FROM users WHERE id = 555")->fetchAll('assoc');
echo "\nTARGET USER 555:\n";
print_r($targetUser);

$trainers = $db->execute("SELECT id, name, user_type, partner_id, active FROM users WHERE user_type = 4")->fetchAll('assoc');
echo "\nALL TRAINERS (user_type = 4):\n";
foreach ($trainers as $t) {
    echo "ID: {$t['id']} | Name: {$t['name']} | Partner ID: {$t['partner_id']} | Active: '{$t['active']}'\n";
}
