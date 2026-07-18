<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        
         $this->belongsTo('Partners', [
            'foreignKey' => 'partner_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('UserRemarks', [
            'foreignKey' => 'user_id',
            'dependent' => true
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('guestid')
            ->maxLength('guestid', 255)
            ->requirePresence('guestid', 'create')
            ->notEmpty('guestid');

        $validator
            ->requirePresence('user_type', 'create')
            ->notEmpty('user_type');

        $validator
            ->scalar('username')
            ->maxLength('username', 100)
            ->requirePresence('username', 'create')
            ->notEmpty('username');

        $validator
            ->email('email')
            ->allowEmpty('email');

//        $validator
//            ->scalar('password')
//            ->maxLength('password', 100)
//            ->requirePresence('password', 'create')
//            ->notEmpty('password');

        $validator
            ->allowEmpty('email_verified');
        $validator
            ->allowEmpty('location');

        $validator
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('contact_person')
            ->allowEmpty('contact_person');

        $validator
            ->scalar('photo')
            ->allowEmpty('photo');

        $validator
            ->integer('gender')
            ->allowEmpty('gender');

        $validator
            ->scalar('aboutme')
            ->allowEmpty('aboutme');

        $validator
            ->scalar('mobile_no')
            ->maxLength('mobile_no', 25)
            ->requirePresence('mobile_no', 'create')
            ->notEmpty('mobile_no');

//        $validator
//            ->requirePresence('active', 'create')
//            ->notEmpty('active');

        $validator
            ->allowEmpty('verified');

//        $validator
//            ->date('dob')
//            ->allowEmpty('dob');

        return $validator;
    }

    /**
     * Validation rules for payment.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationPayment(Validator $validator)
    {
        $validator = $this->validationDefault($validator);
        $validator
            ->requirePresence('email', true, __('Email address is required.'))
            ->notEmpty('email', __('Email address is required.'));
        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add(function ($entity, $options) {
            if (empty($entity->username)) {
                return true;
            }
            $query = $options['repository']->find()
                ->where([
                    'username' => $entity->username,
                    'active !=' => '3'
                ]);
            if (!$entity->isNew()) {
                $query->where(['id !=' => $entity->id]);
            }
            return $query->count() === 0;
        }, 'uniqueUsername', [
            'errorField' => 'username',
            'message' => __('This username is already in use.')
        ]);

        $rules->add(function ($entity, $options) {
            if (empty($entity->email)) {
                return true;
            }
            $query = $options['repository']->find()
                ->where([
                    'email' => $entity->email,
                    'active !=' => '3'
                ]);
            if (!$entity->isNew()) {
                $query->where(['id !=' => $entity->id]);
            }
            return $query->count() === 0;
        }, 'uniqueEmail', [
            'errorField' => 'email',
            'message' => __('This email is already in use.')
        ]);

        return $rules;
    }
}
