<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PtClassEntries Model
 */
class PtClassEntriesTable extends Table
{
    /**
     * Initialize method
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('pt_class_entries');
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

        $this->belongsTo('Users', [
            'className' => 'Users',
            'foreignKey' => 'user_id',
            'joinType' => 'LEFT'
        ]);

        $this->belongsTo('UserPtSubscriptions', [
            'foreignKey' => 'user_pt_subscription_id',
            'joinType' => 'LEFT'
        ]);

        $this->hasOne('PtPayrolls', [
            'className' => 'PtPayrolls',
            'foreignKey' => 'class_entry_id',
            'dependent' => true
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
            ->integer('month')
            ->requirePresence('month', 'create')
            ->notEmpty('month')
            ->range('month', [1, 12], __('Month must be between 1 and 12.'));

        $validator
            ->integer('year')
            ->requirePresence('year', 'create')
            ->notEmpty('year');

        $validator
            ->integer('total_classes')
            ->requirePresence('total_classes', 'create')
            ->notEmpty('total_classes')
            ->greaterThanOrEqual('total_classes', 0, __('Total classes cannot be negative.'));

        $validator
            ->decimal('rate_per_class')
            ->allowEmpty('rate_per_class')
            ->greaterThanOrEqual('rate_per_class', 0, __('Rate per class cannot be negative.'));

        $validator
            ->scalar('notes')
            ->allowEmpty('notes');

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
