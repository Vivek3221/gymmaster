<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PtPlans Table
 */
class PtPlansTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('pt_plans');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Partners', [
            'className' => 'Users',
            'foreignKey' => 'partner_id',
            'joinType' => 'LEFT'
        ]);

        $this->hasMany('UserPtSubscriptions', [
            'foreignKey' => 'pt_plan_id'
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        return $validator;
    }
}
