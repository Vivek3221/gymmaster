<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Session Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $partner_id
 * @property \Cake\I18n\FrozenDate $date
 * @property string $ex_detail
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Partner $partner
 */
class Session extends Entity
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
        'partner_id' => true,
        'date' => true,
        'ex_detail' => true,
        'user_detail' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'partner' => true
    ];
}
