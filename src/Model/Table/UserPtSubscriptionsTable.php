<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserPtSubscriptions Table
 */
class UserPtSubscriptionsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('user_pt_subscriptions');
        $this->setDisplayField('plan_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'className' => 'Users',
            'foreignKey' => 'user_id'
        ]);

        $this->belongsTo('Trainers', [
            'className' => 'Users',
            'foreignKey' => 'trainer_id',
            'conditions' => ['Trainers.user_type' => 4]
        ]);

        $this->belongsTo('Partners', [
            'className' => 'Users',
            'foreignKey' => 'partner_id',
            'joinType' => 'LEFT'
        ]);

        $this->belongsTo('PtPlans', [
            'foreignKey' => 'pt_plan_id'
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('user_id', 'create')
            ->notEmpty('user_id');

        $validator
            ->requirePresence('trainer_id', 'create')
            ->notEmpty('trainer_id');

        return $validator;
    }
}
