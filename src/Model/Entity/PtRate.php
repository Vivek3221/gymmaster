<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PtRate Entity
 */
class PtRate extends Entity
{
    protected $_accessible = [
        'partner_id' => true,
        'trainer_id' => true,
        'rate_per_class' => true,
        'effective_from' => true,
        'status' => true,
        'created_by' => true,
        'updated_by' => true,
        'created' => true,
        'modified' => true,
        'partner' => true,
        'trainer' => true
    ];
}
