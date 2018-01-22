<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FitnessMeserments Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\FitnessMeserment get($primaryKey, $options = [])
 * @method \App\Model\Entity\FitnessMeserment newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FitnessMeserment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FitnessMeserment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FitnessMeserment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FitnessMeserment[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FitnessMeserment findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FitnessMesermentsTable extends Table
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

        $this->setTable('fitness_meserments');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
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

//        $validator
//            ->dateTime('date')
//            ->requirePresence('date', 'create')
//            ->notEmpty('date');

        $validator
            ->scalar('weight')
            ->maxLength('weight', 50)
            ->requirePresence('weight', 'create')
            ->notEmpty('weight');

        $validator
            ->scalar('height')
            ->maxLength('height', 50)
            ->requirePresence('height', 'create')
            ->notEmpty('height');

        $validator
            ->scalar('bmi')
            ->maxLength('bmi', 50)
            ->requirePresence('bmi', 'create')
            ->notEmpty('bmi');

        $validator
            ->scalar('neck')
            ->maxLength('neck', 50)
            ->requirePresence('neck', 'create')
            ->notEmpty('neck');

        $validator
            ->scalar('upper_arm')
            ->maxLength('upper_arm', 50)
            ->requirePresence('upper_arm', 'create')
            ->notEmpty('upper_arm');

        $validator
            ->scalar('chest')
            ->maxLength('chest', 50)
            ->requirePresence('chest', 'create')
            ->notEmpty('chest');

        $validator
            ->scalar('waist')
            ->maxLength('waist', 50)
            ->requirePresence('waist', 'create')
            ->notEmpty('waist');

        $validator
            ->scalar('lower_abdomen')
            ->maxLength('lower_abdomen', 50)
            ->requirePresence('lower_abdomen', 'create')
            ->notEmpty('lower_abdomen');

        $validator
            ->scalar('hips')
            ->maxLength('hips', 50)
            ->requirePresence('hips', 'create')
            ->notEmpty('hips');

        $validator
            ->scalar('thigh')
            ->maxLength('thigh', 50)
            ->requirePresence('thigh', 'create')
            ->notEmpty('thigh');

        $validator
            ->scalar('calf')
            ->maxLength('calf', 50)
            ->requirePresence('calf', 'create')
            ->notEmpty('calf');

//        $validator
//            ->scalar('whr')
//            ->maxLength('whr', 50)
//            ->requirePresence('whr', 'create')
//            ->notEmpty('whr');

//        $validator
//            ->scalar('fat')
//            ->maxLength('fat', 50)
//            ->requirePresence('fat', 'create')
//            ->notEmpty('fat');

//        $validator
//            ->scalar('tricep')
//            ->maxLength('tricep', 50)
//            ->requirePresence('tricep', 'create')
//            ->notEmpty('tricep');

//        $validator
//            ->scalar('abdomen')
//            ->maxLength('abdomen', 50)
//            ->requirePresence('abdomen', 'create')
//            ->notEmpty('abdomen');

//        $validator
//            ->scalar('ad_hold')
//            ->maxLength('ad_hold', 50)
//            ->requirePresence('ad_hold', 'create')
//            ->notEmpty('ad_hold');

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
