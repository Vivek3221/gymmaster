<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PtPayrolls Model
 */
class PtPayrollsTable extends Table
{
    /**
     * Initialize method
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('pt_payrolls');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Partners', [
            'className' => 'Users',
            'foreignKey' => 'partner_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('Trainers', [
            'className' => 'Users',
            'foreignKey' => 'trainer_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('PtClassEntries', [
            'className' => 'PtClassEntries',
            'foreignKey' => 'class_entry_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->decimal('rate_per_class')
            ->requirePresence('rate_per_class', 'create')
            ->notEmpty('rate_per_class')
            ->greaterThanOrEqual('rate_per_class', 0);

        $validator
            ->integer('total_classes')
            ->requirePresence('total_classes', 'create')
            ->notEmpty('total_classes')
            ->greaterThanOrEqual('total_classes', 0);

        $validator
            ->decimal('total_amount')
            ->requirePresence('total_amount', 'create')
            ->notEmpty('total_amount')
            ->greaterThanOrEqual('total_amount', 0);

        $validator
            ->scalar('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->date('payment_date')
            ->allowEmpty('payment_date');

        $validator
            ->integer('paid_by')
            ->allowEmpty('paid_by');

        return $validator;
    }

    /**
     * Rules checker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['partner_id'], 'Partners'));
        $rules->add($rules->existsIn(['trainer_id'], 'Trainers'));
        $rules->add($rules->existsIn(['class_entry_id'], 'PtClassEntries'));

        return $rules;
    }
}
