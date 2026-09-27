<?php
$_SERVER['HTTP_HOST'] = 'localhost';
require 'vendor/autoload.php';
require 'config/bootstrap.php';
use Cake\ORM\TableRegistry;

$table = TableRegistry::get('PlanSubscribers');
$rows = $table->find('all')->order(['id' => 'DESC'])->limit(5)->toArray();

echo "LAST 5 PLAN SUBSCRIBERS:\n";
foreach ($rows as $r) {
    print_r($r->toArray());
    echo "\n-------------------\n";
}
