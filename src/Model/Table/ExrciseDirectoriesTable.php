<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ExrciseDirectories Model
 *
 * @method \App\Model\Entity\ExrciseDirectory get($primaryKey, $options = [])
 * @method \App\Model\Entity\ExrciseDirectory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ExrciseDirectory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ExrciseDirectory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ExrciseDirectory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ExrciseDirectory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ExrciseDirectory findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ExrciseDirectoriesTable extends Table
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

        $this->setTable('exrcise_directories');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->integer('user_id')
            ->notEmpty('user_id', 'create');

        $validator
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('tecnical1')
            ->maxLength('tecnical1', 250)
            ->requirePresence('tecnical1', 'create')
            ->notEmpty('tecnical1');

        $validator
            ->scalar('tecnical2')
            ->maxLength('tecnical2', 250)
            ->requirePresence('tecnical2', 'create')
            ->notEmpty('tecnical2');

        $validator
            ->scalar('tecnical3')
            ->maxLength('tecnical3', 250)
            ->requirePresence('tecnical3', 'create')
            ->notEmpty('tecnical3');

        $validator
            ->scalar('tecnical4')
            ->maxLength('tecnical4', 250)
            ->requirePresence('tecnical4', 'create')
            ->notEmpty('tecnical4');

        $validator
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }
}
