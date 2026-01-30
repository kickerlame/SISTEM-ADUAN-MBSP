<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class User extends Entity
{
    protected array $_accessible = [
        'username' => true,
        'password' => true,
        'ic_number' => true,
        'full_name' => true,
        'email' => true,
        'phone_mobile' => true,
        'status' => true,
        'created_at' => true,
        'updated_at' => true,
    ];

    protected array $_hidden = [
        'password',
    ];

    /**
     * Fungsi Setter untuk hashing password.
     * Setiap kali data 'password' diubah, fungsi ini akan dipanggil secara automatik.
     */
    protected function _setPassword(string $password): ?string
    {
        if (strlen($password) > 0) {
            // Menggunakan fungsi native PHP yang paling selamat (Bcrypt)
            return password_hash($password, PASSWORD_DEFAULT);
        }

        return $password;
    }
}
