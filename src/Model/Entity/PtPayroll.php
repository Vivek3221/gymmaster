<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PtPayroll Entity
 */
class PtPayroll extends Entity
{
    protected $_accessible = [
        'partner_id' => true,
        'trainer_id' => true,
        'class_entry_id' => true,
        'rate_per_class' => true,
        'total_classes' => true,
        'total_amount' => true,
        'status' => true,
        'payment_date' => true,
        'paid_by' => true,
        'created' => true,
        'modified' => true,
        'partner' => true,
        'trainer' => true,
        'class_entry' => true
    ];
}
