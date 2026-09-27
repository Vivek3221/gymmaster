<?php
$pdo = new PDO('mysql:host=localhost;dbname=gymmaster', 'root', '');

// Suppose logged in user is admin (id 21 or 24) or partner (id 25 or 58) or frontdesk (id 550)
foreach ([
    ['users_id' => 21, 'users_type' => 1, 'partner_id' => null, 'label' => 'Admin 21'],
    ['users_id' => 24, 'users_type' => 1, 'partner_id' => null, 'label' => 'Admin 24'],
    ['users_id' => 58, 'users_type' => 2, 'partner_id' => 24, 'label' => 'Partner 58 (STAR HIIT)'],
    ['users_id' => 25, 'users_type' => 2, 'partner_id' => 24, 'label' => 'Partner 25 (Vivek)'],
    ['users_id' => 550, 'users_type' => 5, 'partner_id' => 58, 'label' => 'Front Desk 550']
] as $login) {
    echo "=== {$login['label']} ===\n";
    $users_type = $login['users_type'];
    $users_id = $login['users_id'];
    $usersdetail = ['partner_id' => $login['partner_id']];

    // IN ADD:
    $partnerIdForTrainers = ($users_type == 2) ? $users_id : (($users_type == 5 && !empty($usersdetail['partner_id'])) ? $usersdetail['partner_id'] : null);
    $trainerConditions = ['Users.user_type' => 4, 'Users.active' => '1'];
    if (!empty($partnerIdForTrainers)) {
        $sql = "SELECT id, name FROM users WHERE user_type = 4 AND active = '1' AND partner_id = {$partnerIdForTrainers}";
    } else {
        $sql = "SELECT id, name FROM users WHERE user_type = 4 AND active = '1'";
    }
    $addTrainers = $pdo->query($sql)->fetchAll(PDO::FETCH_KEY_PAIR);
    if (empty($addTrainers)) {
        $addTrainers = $pdo->query("SELECT id, name FROM users WHERE user_type = 4 AND active = '1'")->fetchAll(PDO::FETCH_KEY_PAIR);
    }
    echo "IN ADD: " . count($addTrainers) . " trainers found: " . implode(', ', array_slice($addTrainers, 0, 3)) . "...\n";

    // IN PAYMENT for user 546 (target user partner_id = 24):
    $userPartnerId = 24;
    $trainerPartnerId = ($users_type == 2) ? $users_id : (($users_type == 5 && !empty($usersdetail['partner_id'])) ? $usersdetail['partner_id'] : (!empty($userPartnerId) ? $userPartnerId : $users_id));
    if ($users_type == 1) {
        $sql = "SELECT id, name FROM users WHERE user_type = 4 AND active != '3'";
    } else {
        $sql = "SELECT id, name FROM users WHERE user_type = 4 AND partner_id = {$trainerPartnerId} AND active != '3'";
    }
    $payTrainers = $pdo->query($sql)->fetchAll(PDO::FETCH_KEY_PAIR);
    if (empty($payTrainers)) {
        $payTrainers = $pdo->query("SELECT id, name FROM users WHERE user_type = 4 AND active != '3'")->fetchAll(PDO::FETCH_KEY_PAIR);
    }
    echo "IN PAYMENT (for user 546): " . count($payTrainers) . " trainers found\n";
    
    // Check if CakePHP find('list') returns array or Query object in payment()
}
