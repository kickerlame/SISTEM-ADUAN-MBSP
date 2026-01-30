<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Officer Entity
 *
 * @property int $officer_id
 * @property string $username
 * @property string $password
 * @property string $role
 * @property string|null $status
 * @property string $full_name
 * @property string $staff_id
 * @property int $department_id
 * @property string|null $phone_no
 *
 * @property \App\Model\Entity\Department $department
 */
class Officer extends Entity
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
        'username' => true,
        'password' => true,
        'role' => true,
        'status' => true,
        'full_name' => true,
        'staff_id' => true,
        'department_id' => true,
        'phone_no' => true,
        'department' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected array $_hidden = [
        'password',
    ];

    /**
     * Password setter - automatically hash password
     */
    protected function _setPassword(string $password): ?string
    {
        if (strlen($password) > 0) {
            return password_hash($password, PASSWORD_DEFAULT);
        }

        return $password;
    }
}
