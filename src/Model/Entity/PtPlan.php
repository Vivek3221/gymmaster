<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PtPlan Entity
 */
class PtPlan extends Entity
{
    protected $_accessible = [
        'partner_id' => true,
        'title' => true,
        'duration_months' => true,
        'total_classes' => true,
        'price' => true,
        'per_class_rate' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'partner' => true,
        'user_pt_subscriptions' => true
    ];
}
