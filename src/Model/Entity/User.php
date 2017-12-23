<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $guestid
 * @property int $user_type
 * @property string $username
 * @property string $email
 * @property string $password
 * @property int $email_verified
 * @property string $name
 * @property string $contact_person
 * @property string $photo
 * @property int $gender
 * @property string $aboutme
 * @property string $mobile_no
 * @property int $active
 * @property int $verified
 * @property \Cake\I18n\FrozenDate $dob
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class User extends Entity
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
        'guestid' => true,
        'user_type' => true,
        'username' => true,
        'email' => true,
        'password' => true,
        'email_verified' => true,
        'name' => true,
        'contact_person' => true,
        'photo' => true,
        'gender' => true,
        'aboutme' => true,
        'mobile_no' => true,
        'active' => true,
        'verified' => true,
        'dob' => true,
        'created' => true,
        'modified' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
