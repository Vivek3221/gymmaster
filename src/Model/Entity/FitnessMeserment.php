<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FitnessMeserment Entity
 *
 * @property int $id
 * @property int $user_id
 * @property \Cake\I18n\FrozenTime $date
 * @property string $weight
 * @property string $height
 * @property string $bmi
 * @property string $neck
 * @property string $upper_arm
 * @property string $chest
 * @property string $waist
 * @property string $lower_abdomen
 * @property string $hips
 * @property string $thigh
 * @property string $calf
 * @property string $whr
 * @property string $fat
 * @property string $tricep
 * @property string $abdomen
 * @property string $ad_hold
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 */
class FitnessMeserment extends Entity
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
        'date' => true,
        'weight' => true,
        'height' => true,
        'bmi' => true,
        'neck' => true,
        'upper_arm' => true,
        'chest' => true,
        'waist' => true,
        'lower_abdomen' => true,
        'hips' => true,
        'thigh' => true,
        'calf' => true,
        'whr' => true,
        'fat' => true,
        'tricep' => true,
        'abdomen' => true,
        'ad_hold' => true,
        'created' => true,
        'modified' => true,
        'partner_id' => true,
        'user' => true
    ];
}
