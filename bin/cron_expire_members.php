<?php
/**
 * Standalone Cron Runner for Expiring GymMaster Memberships
 *
 * Can be run directly via CLI:
 *   php bin/cron_expire_members.php
 * Or configured in Windows Task Scheduler / Linux crontab.
 */

// Suppress PHP deprecation notices from older CakePHP core
error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);

// If running in CLI, proceed. If HTTP, check secret token.
$isCli = (php_sapi_name() === 'cli' || defined('STDIN'));
$token = $_GET['token'] ?? $_POST['token'] ?? ($argv[1] ?? '');
$validToken = 'gymmaster_cron_2026';

if (!$isCli && $token !== $validToken) {
    http_response_code(403);
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Unauthorized access. Valid token parameter required.']);
    exit(1);
}

if (empty($_SERVER['HTTP_HOST'])) {
    $_SERVER['HTTP_HOST'] = 'localhost';
}

// Bootstrap CakePHP application
require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/config/bootstrap.php';

use Cake\ORM\TableRegistry;

$usersTable = TableRegistry::get('Users');
$planSubscribersTable = TableRegistry::get('PlanSubscribers');
$today = date('Y-m-d');

// Subquery: Has any active or future plan expiring today or in the future
$activePlanSubquery = $planSubscribersTable->find()
    ->select(['PlanSubscribers.id'])
    ->where([
        'PlanSubscribers.user_id = Users.id',
        'PlanSubscribers.plan_expire_date >=' => $today . ' 00:00:00'
    ]);

// Find active members (user_type = 3, active = 1) who have an expired plan AND no active/future plan
$expiredMembers = $usersTable->find()
    ->select(['id', 'name', 'email', 'partner_id'])
    ->where([
        'Users.user_type' => 3,
        'Users.active' => 1
    ])
    ->where(function ($exp) use ($activePlanSubquery, $planSubscribersTable, $today) {
        $hasExpiredPlanSubquery = $planSubscribersTable->find()
            ->select(['PlanSubscribers.id'])
            ->where([
                'PlanSubscribers.user_id = Users.id',
                'PlanSubscribers.plan_expire_date <' => $today . ' 00:00:00'
            ]);

        return $exp
            ->exists($hasExpiredPlanSubquery)
            ->notExists($activePlanSubquery);
    })
    ->toArray();

$count = 0;
$updatedList = [];
if (!empty($expiredMembers)) {
    foreach ($expiredMembers as $m) {
        $usersTable->updateAll(
            ['active' => 0],
            ['id' => $m->id]
        );
        $updatedList[] = [
            'id'    => $m->id,
            'name'  => $m->name,
            'email' => $m->email
        ];
        $count++;
    }
}

$response = [
    'success'       => true,
    'updated_count' => $count,
    'message'       => "Successfully marked {$count} expired member(s) as Inactive.",
    'timestamp'     => date('Y-m-d H:i:s'),
    'members'       => $updatedList
];

if (!$isCli) {
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
} else {
    echo "[GymMaster Cron] " . $response['message'] . PHP_EOL;
}
