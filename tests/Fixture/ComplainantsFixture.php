<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ComplainantsFixture
 */
class ComplainantsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'complainant_id' => 1,
                'full_name' => 'Lorem ipsum dolor sit amet',
                'ic_number' => 'Lorem ipsu',
                'phone_mobile' => 'Lorem ipsum dolor ',
                'email' => 'Lorem ipsum dolor sit amet',
                'created_at' => 1768677877,
            ],
        ];
        parent::init();
    }
}
