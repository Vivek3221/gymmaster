<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ExrciseDirectory Entity
 *
 * @property int $id
 * @property string $name
 * @property string $tecnical1
 * @property string $tecnical2
 * @property string $tecnical3
 * @property string $tecnical4
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class ExrciseDirectory extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'tecnical1' => true,
        'tecnical2' => true,
        'tecnical3' => true,
        'tecnical4' => true,
        'status' => true,
        'created' => true,
        'modified' => true
    ];
}
