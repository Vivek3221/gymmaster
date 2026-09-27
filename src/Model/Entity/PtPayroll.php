<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PtPayroll Entity
 */
class PtPayroll extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
