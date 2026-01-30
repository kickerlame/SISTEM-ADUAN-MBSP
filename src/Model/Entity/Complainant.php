<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Complainant Entity
 *
 * @property int $complainant_id
 * @property string $full_name
 * @property string $ic_number
 * @property string $phone_mobile
 * @property string|null $email
 * @property \Cake\I18n\DateTime|null $created_at
 */
class Complainant extends Entity
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
        'full_name' => true,
        'ic_number' => true,
        'phone_mobile' => true,
        'email' => true,
        'created_at' => true,
    ];
}
