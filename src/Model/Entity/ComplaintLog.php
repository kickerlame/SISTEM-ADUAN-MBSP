<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ComplaintLog Entity
 *
 * @property int $log_id
 * @property int $complaint_id
 * @property int|null $user_id
 * @property string $action_taken
 * @property string|null $notes
 * @property int|null $status_after
 * @property \Cake\I18n\DateTime|null $created_at
 *
 * @property \App\Model\Entity\Complaint $complaint
 * @property \App\Model\Entity\User $user
 */
class ComplaintLog extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'complaint_id' => true,
        'user_id' => true,
        'action_taken' => true,
        'notes' => true,
        'status_after' => true,
        'created_at' => true,
        'complaint' => true,
        'user' => true,
    ];
}
