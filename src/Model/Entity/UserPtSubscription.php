<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserPtSubscription Entity
 */
class UserPtSubscription extends Entity
{
    protected $_accessible = [
        'partner_id' => true,
        'user_id' => true,
        'trainer_id' => true,
        'pt_plan_id' => true,
        'plan_name' => true,
        'total_classes' => true,
        'completed_classes' => true,
        'total_amount' => true,
        'client_per_class_rate' => true,
        'start_date' => true,
        'end_date' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'trainer' => true,
        'partner' => true,
        'pt_plan' => true
    ];
}
