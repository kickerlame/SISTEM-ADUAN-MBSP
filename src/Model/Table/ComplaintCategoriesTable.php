<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ComplaintCategories Model
 *
 * @property \App\Model\Table\DepartmentsTable&\Cake\ORM\Association\BelongsTo $Departments
 * @method \App\Model\Entity\ComplaintCategory newEmptyEntity()
 * @method \App\Model\Entity\ComplaintCategory newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\ComplaintCategory> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ComplaintCategory get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\ComplaintCategory findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\ComplaintCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\ComplaintCategory> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ComplaintCategory|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\ComplaintCategory saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\ComplaintCategory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ComplaintCategory>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ComplaintCategory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ComplaintCategory> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ComplaintCategory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ComplaintCategory>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ComplaintCategory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ComplaintCategory> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ComplaintCategoriesTable extends Table
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

        $this->setTable('complaint_categories');
        $this->setDisplayField('category_name');
        $this->setPrimaryKey('category_id');

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
            ->integer('department_id')
            ->notEmptyString('department_id');

        $validator
            ->scalar('category_name')
            ->maxLength('category_name', 100)
            ->requirePresence('category_name', 'create')
            ->notEmptyString('category_name');

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
        $rules->add($rules->existsIn(['department_id'], 'Departments'), ['errorField' => 'department_id']);

        return $rules;
    }
}
