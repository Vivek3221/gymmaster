<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bodies Model
 *
 * @property \App\Model\Table\ExerciseTable|\Cake\ORM\Association\HasMany $Exercise
 *
 * @method \App\Model\Entity\Body get($primaryKey, $options = [])
 * @method \App\Model\Entity\Body newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Body[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Body|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Body patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Body[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Body findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BodiesTable extends Table
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

        $this->setTable('bodies');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Exercise', [
            'foreignKey' => 'body_id'
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
            ->scalar('name')
            ->maxLength('name', 200)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('description')
            ->allowEmpty('description');

        $validator
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }
}
