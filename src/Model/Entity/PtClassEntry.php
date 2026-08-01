<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PtClassEntry Entity
 */
class PtClassEntry extends Entity
{
    protected $_accessible = [
        'partner_id' => true,
        'trainer_id' => true,
        'month' => true,
        'year' => true,
        'total_classes' => true,
        'rate_per_class' => true,
        'notes' => true,
        'created_by' => true,
        'updated_by' => true,
        'created' => true,
        'modified' => true,
        'partner' => true,
        'trainer' => true
    ];
}
