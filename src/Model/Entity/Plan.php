<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Plan Entity
 *
 * @property int    $id
 * @property int    $partner_id
 * @property string $title
 * @property int    $duration_months
 * @property int    $days
 * @property float  $price
 * @property string $description
 * @property int    $active
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Plan extends Entity
{
    protected $_accessible = [
        'partner_id'      => true,
        'title'           => true,
        'duration_months' => true,
        'days'            => true,
        'price'           => true,
        'description'     => true,
        'active'          => true,
        'created'         => true,
        'modified'        => true,
    ];
}
