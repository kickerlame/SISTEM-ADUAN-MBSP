<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ComplaintLogs Model
 *
 * @property \App\Model\Table\ComplaintsTable&\Cake\ORM\Association\BelongsTo $Complaints
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @method \App\Model\Entity\ComplaintLog newEmptyEntity()
 * @method \App\Model\Entity\ComplaintLog newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\ComplaintLog> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ComplaintLog get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\ComplaintLog findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\ComplaintLog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\ComplaintLog> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ComplaintLog|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\ComplaintLog saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\ComplaintLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ComplaintLog>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ComplaintLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ComplaintLog> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ComplaintLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ComplaintLog>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ComplaintLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ComplaintLog> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ComplaintLogsTable extends Table
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

        $this->setTable('complaint_logs');
        $this->setDisplayField('action_taken');
        $this->setPrimaryKey('log_id');

        $this->belongsTo('Complaints', [
            'foreignKey' => 'complaint_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->integer('complaint_id')
            ->notEmptyString('complaint_id');

        $validator
            ->integer('user_id')
            ->allowEmptyString('user_id');

        $validator
            ->scalar('action_taken')
            ->maxLength('action_taken', 255)
            ->requirePresence('action_taken', 'create')
            ->notEmptyString('action_taken');

        $validator
            ->scalar('notes')
            ->allowEmptyString('notes');

        $validator
            ->integer('status_after')
            ->allowEmptyString('status_after');

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
        $rules->add($rules->existsIn(['complaint_id'], 'Complaints'), ['errorField' => 'complaint_id']);
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
