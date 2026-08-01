<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PtRates Model
 */
class PtRatesTable extends Table
{
    /**
     * Initialize method
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('pt_rates');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Partners', [
            'className' => 'Users',
            'foreignKey' => 'partner_id',
            'joinType' => 'LEFT'
        ]);

        $this->belongsTo('Trainers', [
            'className' => 'Users',
            'foreignKey' => 'trainer_id',
            'joinType' => 'LEFT'
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
            ->greaterThanOrEqual('rate_per_class', 0, __('Rate per class cannot be negative.'));

        $validator
            ->date('effective_from')
            ->requirePresence('effective_from', 'create')
            ->notEmpty('effective_from');

        $validator
            ->integer('status')
            ->allowEmpty('status');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        $validator
            ->integer('updated_by')
            ->allowEmpty('updated_by');

        return $validator;
    }

    /**
     * Rules checker
     */
    public function buildRules(RulesChecker $rules)
    {
        return $rules;
    }
}
