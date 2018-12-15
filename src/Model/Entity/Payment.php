<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Payment Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $partner_id
 * @property int $plan_subscriber_id
 * @property int $amount
 * @property string $currency
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Partner $partner
 * @property \App\Model\Entity\PlanSubscriber $plan_subscriber
 */
class Payment extends Entity
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
        'plan_subscriber_id' => true,
        'amount' => true,
        'currency' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'partner' => true,
        'plan_subscriber' => true
    ];
}
