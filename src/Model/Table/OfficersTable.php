<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Officers Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\DepartmentsTable&\Cake\ORM\Association\BelongsTo $Departments
 * @method \App\Model\Entity\Officer newEmptyEntity()
 * @method \App\Model\Entity\Officer newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Officer> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Officer get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Officer findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Officer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Officer> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Officer|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Officer saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Officer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Officer>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Officer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Officer> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Officer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Officer>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Officer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Officer> deleteManyOrFail(iterable $entities, array $options = [])
 */
class OfficersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('officers');
        $this->setDisplayField('full_name');
        $this->setPrimaryKey('officer_id');

        $this->belongsTo('Departments', [
            'foreignKey' => 'department_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('username')
            ->maxLength('username', 50)
            ->requirePresence('username', 'create')
            ->notEmptyString('username')
            ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password', null, 'create')
            ->allowEmptyString('password', null, 'update');

        $validator
            ->scalar('role')
            ->notEmptyString('role');

        $validator
            ->scalar('status')
            ->allowEmptyString('status');

        $validator
            ->integer('department_id')
            ->notEmptyString('department_id');

        $validator
            ->scalar('full_name')
            ->maxLength('full_name', 100)
            ->requirePresence('full_name', 'create')
            ->notEmptyString('full_name');

        $validator
            ->scalar('staff_id')
            ->maxLength('staff_id', 20)
            ->requirePresence('staff_id', 'create')
            ->notEmptyString('staff_id')
            ->add('staff_id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('phone_no')
            ->maxLength('phone_no', 20)
            ->allowEmptyString('phone_no');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['username']), ['errorField' => 'username']);
        $rules->add($rules->isUnique(['staff_id']), ['errorField' => 'staff_id']);
        $rules->add($rules->existsIn(['department_id'], 'Departments'), ['errorField' => 'department_id']);

        return $rules;
    }
}
