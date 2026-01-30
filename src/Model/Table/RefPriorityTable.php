<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RefPriority Model
 *
 * @method \App\Model\Entity\RefPriority newEmptyEntity()
 * @method \App\Model\Entity\RefPriority newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\RefPriority> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RefPriority get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\RefPriority findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\RefPriority patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\RefPriority> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RefPriority|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\RefPriority saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\RefPriority>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RefPriority>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RefPriority>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RefPriority> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RefPriority>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RefPriority>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RefPriority>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RefPriority> deleteManyOrFail(iterable $entities, array $options = [])
 */
class RefPriorityTable extends Table
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

        $this->setTable('ref_priority');
        $this->setDisplayField('priority_label');
        $this->setPrimaryKey('priority_id');
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
            ->scalar('priority_label')
            ->maxLength('priority_label', 20)
            ->requirePresence('priority_label', 'create')
            ->notEmptyString('priority_label');

        $validator
            ->integer('sla_hours')
            ->requirePresence('sla_hours', 'create')
            ->notEmptyString('sla_hours');

        return $validator;
    }
}
