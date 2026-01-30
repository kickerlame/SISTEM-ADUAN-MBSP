<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Complainants Model
 *
 * @method \App\Model\Entity\Complainant newEmptyEntity()
 * @method \App\Model\Entity\Complainant newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Complainant> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Complainant get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Complainant findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Complainant patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Complainant> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Complainant|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Complainant saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Complainant>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Complainant>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Complainant>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Complainant> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Complainant>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Complainant>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Complainant>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Complainant> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ComplainantsTable extends Table
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

        $this->setTable('complainants');
        $this->setDisplayField('full_name');
        $this->setPrimaryKey('complainant_id');
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
            ->scalar('full_name')
            ->maxLength('full_name', 150)
            ->requirePresence('full_name', 'create')
            ->notEmptyString('full_name');

        $validator
            ->scalar('ic_number')
            ->maxLength('ic_number', 12)
            ->requirePresence('ic_number', 'create')
            ->notEmptyString('ic_number')
            ->add('ic_number', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('phone_mobile')
            ->maxLength('phone_mobile', 20)
            ->requirePresence('phone_mobile', 'create')
            ->notEmptyString('phone_mobile');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->dateTime('created_at')
            ->allowEmptyDateTime('created_at');

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
        $rules->add($rules->isUnique(['ic_number']), ['errorField' => 'ic_number']);

        return $rules;
    }
}
