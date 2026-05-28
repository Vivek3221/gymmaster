<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserRemark Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $remark
 * @property \Cake\I18n\FrozenTime $followup_date
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 */
class UserRemark extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
