<?php
$_SERVER['HTTP_HOST'] = 'localhost';
require_once 'vendor/autoload.php';
require_once 'config/bootstrap.php';
use Cake\ORM\TableRegistry;

$usersTbl = TableRegistry::get('Users');
$users_id = 58;
$users_type = 2;
$user = $usersTbl->get(555);

$partnerIdForTrainers = ($users_type == 2) ? $users_id : (($users_type == 5 && !empty($this->usersdetail['partner_id'])) ? $this->usersdetail['partner_id'] : (!empty($user->partner_id) ? $user->partner_id : null));
$trainerConditions = ['Users.user_type' => 4, 'Users.active' => '1'];
if (!empty($partnerIdForTrainers)) {
    $trainerConditions['Users.partner_id'] = $partnerIdForTrainers;
}

$trainers = $usersTbl->find('list', [
    'keyField' => 'id',
    'valueField' => 'name'
])->where($trainerConditions)->toArray();

echo "TRAINERS WITH ACTIVE = '1':\n";
print_r($trainers);

$trainersAll = $usersTbl->find('list', [
    'keyField' => 'id',
    'valueField' => 'name'
])->where(['Users.user_type' => 4, 'Users.partner_id' => $users_id])->toArray();

echo "\nTRAINERS WITHOUT ACTIVE FILTER (ORIGINAL):\n";
print_r($trainersAll);
