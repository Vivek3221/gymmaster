<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DietDirectories Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\DietDirectory get($primaryKey, $options = [])
 * @method \App\Model\Entity\DietDirectory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DietDirectory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DietDirectory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DietDirectory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DietDirectory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DietDirectory findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DietDirectoriesTable extends Table
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

        $this->setTable('diet_directories');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
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
            ->maxLength('name', 250)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->integer('user_type')
            ->allowEmpty('user_type');

        $validator
            ->scalar('technical1')
            ->maxLength('technical1', 200)
            ->requirePresence('technical1', 'create')
            ->notEmpty('technical1');

        $validator
            ->scalar('technical2')
            ->maxLength('technical2', 250)
            ->requirePresence('technical2', 'create')
            ->notEmpty('technical2');

        $validator
            ->scalar('technical3')
            ->maxLength('technical3', 250)
            ->requirePresence('technical3', 'create')
            ->notEmpty('technical3');

        $validator
            ->scalar('technical4')
            ->maxLength('technical4', 250)
            ->requirePresence('technical4', 'create')
            ->notEmpty('technical4');

        $validator
            ->scalar('technical5')
            ->maxLength('technical5', 250)
            ->allowEmpty('technical5');

        $validator
            ->requirePresence('status', 'create')
            ->notEmpty('status');

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

        return $rules;
    }
}
