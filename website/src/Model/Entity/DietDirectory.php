<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DietDirectory Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property int $user_type
 * @property string $technical1
 * @property string $technical2
 * @property string $technical3
 * @property string $technical4
 * @property string $technical5
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 */
class DietDirectory extends Entity
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
        'user_id' => true,
        'name' => true,
        'user_type' => true,
        'technical1' => true,
        'technical2' => true,
        'technical3' => true,
        'technical4' => true,
        'technical5' => true,
        'technical6' => true,
        'technical7' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'user' => true
    ];
}
