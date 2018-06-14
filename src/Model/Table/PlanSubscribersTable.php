<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PlanSubscribers Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\PartnersTable|\Cake\ORM\Association\BelongsTo $Partners
 * @property \App\Model\Table\PaymentsTable|\Cake\ORM\Association\HasMany $Payments
 *
 * @method \App\Model\Entity\PlanSubscriber get($primaryKey, $options = [])
 * @method \App\Model\Entity\PlanSubscriber newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PlanSubscriber[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PlanSubscriber|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlanSubscriber patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PlanSubscriber[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PlanSubscriber findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PlanSubscribersTable extends Table
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

        $this->setTable('plan_subscribers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Partners', [
            'foreignKey' => 'partner_id'
        ]);
        $this->hasMany('Payments', [
            'foreignKey' => 'plan_subscriber_id'
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
            ->scalar('plan_name')
            ->maxLength('plan_name', 100)
            ->requirePresence('plan_name', 'create')
            ->notEmpty('plan_name');

        $validator
            ->integer('fee')
            ->requirePresence('fee', 'create')
            ->notEmpty('fee');

        $validator
            ->scalar('currency')
            ->maxLength('currency', 3)
            ->requirePresence('currency', 'create')
            ->notEmpty('currency');

        $validator
            ->dateTime('plan_expire_date')
            ->requirePresence('plan_expire_date', 'create')
            ->notEmpty('plan_expire_date');

        $validator
            ->dateTime('payment_due_date')
            ->requirePresence('payment_due_date', 'create')
            ->notEmpty('payment_due_date');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['partner_id'], 'Partners'));

        return $rules;
    }
}
