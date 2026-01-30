<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RefStatus Model
 *
 * @method \App\Model\Entity\RefStatus newEmptyEntity()
 * @method \App\Model\Entity\RefStatus newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\RefStatus> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RefStatus get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\RefStatus findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\RefStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\RefStatus> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RefStatus|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\RefStatus saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\RefStatus>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RefStatus>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RefStatus>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RefStatus> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RefStatus>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RefStatus>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RefStatus>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RefStatus> deleteManyOrFail(iterable $entities, array $options = [])
 */
class RefStatusTable extends Table
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

        $this->setTable('ref_status');
        $this->setDisplayField('status_name');
        $this->setPrimaryKey('status_id');
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
            ->scalar('status_name')
            ->maxLength('status_name', 50)
            ->requirePresence('status_name', 'create')
            ->notEmptyString('status_name');

        $validator
            ->scalar('status_color')
            ->maxLength('status_color', 7)
            ->allowEmptyString('status_color');

        return $validator;
    }
}
