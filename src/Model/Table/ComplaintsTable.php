<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Complaints Model
 *
 * @property \App\Model\Table\ComplainantsTable&\Cake\ORM\Association\BelongsTo $Complainants
 * @property \App\Model\Table\ComplaintCategoriesTable&\Cake\ORM\Association\BelongsTo $Categories
 * @property \App\Model\Table\RefStatusTable&\Cake\ORM\Association\BelongsTo $Statuses
 * @property \App\Model\Table\RefPriorityTable&\Cake\ORM\Association\BelongsTo $Priorities
 * @property \App\Model\Table\OfficersTable&\Cake\ORM\Association\BelongsTo $Officers
 * @method \App\Model\Entity\Complaint newEmptyEntity()
 * @method \App\Model\Entity\Complaint newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Complaint> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Complaint get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Complaint findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Complaint patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Complaint> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Complaint|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Complaint saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Complaint>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Complaint>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Complaint>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Complaint> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Complaint>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Complaint>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Complaint>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Complaint> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ComplaintsTable extends Table
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

        $this->setTable('complaints');
        $this->setDisplayField('complaint_no');
        $this->setPrimaryKey('complaint_id');

        $this->belongsTo('Complainants', [
            'foreignKey' => 'complainant_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'className' => 'ComplaintCategories',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Statuses', [
            'foreignKey' => 'status_id',
            'className' => 'RefStatus',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Priorities', [
            'foreignKey' => 'priority_id',
            'className' => 'RefPriority',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Officers', [
            'foreignKey' => 'officer_id',
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
            ->scalar('complaint_no')
            ->maxLength('complaint_no', 50)
            ->notEmptyString('complaint_no')
            ->add('complaint_no', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('complaint_title')
            ->maxLength('complaint_title', 255)
            ->requirePresence('complaint_title', 'create')
            ->notEmptyString('complaint_title');

        $validator
            ->integer('complainant_id')
            ->notEmptyString('complainant_id');

        $validator
            ->integer('category_id')
            ->notEmptyString('category_id');

        $validator
            ->integer('status_id')
            ->notEmptyString('status_id');

        $validator
            ->integer('priority_id')
            ->notEmptyString('priority_id');

        $validator
            ->integer('officer_id')
            ->allowEmptyString('officer_id');

        $validator
            ->scalar('location_address')
            ->requirePresence('location_address', 'create')
            ->notEmptyString('location_address');

        $validator
            ->scalar('district')
            ->requirePresence('district', 'create')
            ->notEmptyString('district');

        $validator
            ->scalar('details')
            ->requirePresence('details', 'create')
            ->notEmptyString('details');

        $validator
            ->decimal('latitude')
            ->allowEmptyString('latitude');

        $validator
            ->decimal('longitude')
            ->allowEmptyString('longitude');

        $validator
            ->boolean('is_validated')
            ->allowEmptyString('is_validated');

        $validator
            ->dateTime('deadline_at')
            ->allowEmptyDateTime('deadline_at');

        $validator
            ->dateTime('created_at')
            ->allowEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmptyDateTime('updated_at');

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
        $rules->add($rules->isUnique(['complaint_no']), ['errorField' => 'complaint_no']);
        $rules->add($rules->existsIn(['complainant_id'], 'Complainants'), ['errorField' => 'complainant_id']);
        $rules->add($rules->existsIn(['category_id'], 'Categories'), ['errorField' => 'category_id']);
        $rules->add($rules->existsIn(['status_id'], 'Statuses'), ['errorField' => 'status_id']);
        $rules->add($rules->existsIn(['priority_id'], 'Priorities'), ['errorField' => 'priority_id']);
        $rules->add($rules->existsIn(['officer_id'], 'Officers'), ['errorField' => 'officer_id']);

        return $rules;
    }
}
