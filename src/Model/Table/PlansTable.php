<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Plans Model
 *
 * @method \App\Model\Entity\Plan get($primaryKey, $options = [])
 * @method \App\Model\Entity\Plan newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Plan[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Plan|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Plan patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Plan[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Plan findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PlansTable extends Table
{
    /**
     * Duration in months => number of days mapping
     */
    public static $durationDaysMap = [
        1  => 30,
        2  => 60,
        3  => 90,
        6  => 180,
        12 => 365,
        24 => 730,
    ];

    /**
     * Accurately calculate days for 1 to 24+ months:
     * - 1 to 11 months: months * 30
     * - 12 months: 365 days (1 full year)
     * - 13 to 23 months: 365 + ((months - 12) * 30)
     * - 24 months: 730 days (2 full years = 365 * 2)
     */
    public static function calculateDays($months)
    {
        $months = (int)$months;
        if ($months <= 0) {
            return 0;
        }
        if ($months < 12) {
            return $months * 30;
        }
        if ($months == 12) {
            return 365;
        }
        if ($months < 24) {
            return 365 + (($months - 12) * 30);
        }
        if ($months == 24) {
            return 730;
        }
        return (int)(floor($months / 12) * 365) + (($months % 12) * 30);
    }

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('plans');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 150)
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->integer('duration_months')
            ->requirePresence('duration_months', 'create')
            ->notEmpty('duration_months')
            ->add('duration_months', 'range', [
                'rule' => ['range', 1, 24],
                'message' => 'Duration must be between 1 and 24 months.'
            ]);

        $validator
            ->integer('days')
            ->requirePresence('days', 'create')
            ->notEmpty('days');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        return $validator;
    }
}
