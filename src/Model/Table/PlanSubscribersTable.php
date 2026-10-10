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
        $this->setDisplayField('plan_name');
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

        $this->getSchema()->addColumn('subscription_start_date', ['type' => 'date']);
        $this->getSchema()->addColumn('reminder_date', ['type' => 'date']);
        $this->getSchema()->addColumn('collection_type', ['type' => 'string']);
    }

    public function _initializeSchema(\Cake\Database\Schema\TableSchema $schema)
    {
        $schema->addColumn('subscription_start_date', ['type' => 'date']);
        $schema->addColumn('reminder_date', ['type' => 'date']);
        $schema->addColumn('collection_type', ['type' => 'string']);
        return $schema;
    }

    /**
     * Normalize incoming form data before entity marshaling
     */
    public function beforeMarshal(\Cake\Event\Event $event, \ArrayObject $data, \ArrayObject $options)
    {
        if (isset($data['plan_expire_date']) && is_string($data['plan_expire_date'])) {
            $val = trim($data['plan_expire_date']);
            if ($val !== '') {
                $time = strtotime($val);
                if ($time !== false) {
                    $data['plan_expire_date'] = (strlen($val) <= 10) ? date('Y-m-d 23:59:59', $time) : date('Y-m-d H:i:s', $time);
                }
            }
        }

        if (isset($data['subscription_start_date']) && is_string($data['subscription_start_date'])) {
            $val = trim($data['subscription_start_date']);
            if ($val !== '') {
                $time = strtotime($val);
                if ($time !== false) {
                    $data['subscription_start_date'] = date('Y-m-d', $time);
                }
            }
        }

        if (isset($data['payment_due_date']) && is_string($data['payment_due_date'])) {
            $val = trim($data['payment_due_date']);
            if ($val !== '') {
                $time = strtotime($val);
                if ($time !== false) {
                    $data['payment_due_date'] = (strlen($val) <= 10) ? date('Y-m-d 00:00:00', $time) : date('Y-m-d H:i:s', $time);
                }
            }
        }

        if (isset($data['fee']) && is_string($data['fee'])) {
            $data['fee'] = (float)str_replace(',', '', trim($data['fee']));
        }
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
            ->numeric('fee')
            ->requirePresence('fee', 'create')
            ->notEmpty('fee');

        $validator
            ->scalar('currency')
            ->maxLength('currency', 3)
            ->allowEmpty('currency');

        $validator
            ->requirePresence('plan_expire_date', 'create')
            ->notEmpty('plan_expire_date', 'Plan expire date is required')
            ->add('plan_expire_date', 'validDate', [
                'rule' => function ($value, $context) {
                    if ($value instanceof \DateTimeInterface) return true;
                    return is_string($value) && (bool)strtotime($value);
                },
                'message' => 'Please provide a valid plan expire date'
            ]);

        $validator
            ->allowEmpty('payment_due_date')
            ->add('payment_due_date', 'validDate', [
                'rule' => function ($value, $context) {
                    if (empty($value)) return true;
                    if ($value instanceof \DateTimeInterface) return true;
                    return is_string($value) && (bool)strtotime($value);
                },
                'message' => 'Please provide a valid payment due date'
            ]);

        $validator
            ->allowEmpty('subscription_start_date')
            ->add('subscription_start_date', 'validDate', [
                'rule' => function ($value, $context) {
                    if (empty($value)) return true;
                    if ($value instanceof \DateTimeInterface) return true;
                    return is_string($value) && (bool)strtotime($value);
                },
                'message' => 'Please provide a valid subscription start date'
            ]);

        $validator
            ->allowEmpty('reminder_date')
            ->add('reminder_date', 'validDate', [
                'rule' => function ($value, $context) {
                    if (empty($value)) return true;
                    if ($value instanceof \DateTimeInterface) return true;
                    return is_string($value) && (bool)strtotime($value);
                },
                'message' => 'Please provide a valid reminder date'
            ]);

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
        $rules->add($rules->existsIn(['partner_id'], 'Users', ['allowNullableNulls' => true]));

        return $rules;
    }
}
