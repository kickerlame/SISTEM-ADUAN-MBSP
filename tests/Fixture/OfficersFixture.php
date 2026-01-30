<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OfficersFixture
 */
class OfficersFixture extends TestFixture
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
                'officer_id' => 1,
                'user_id' => 1,
                'department_id' => 1,
                'full_name' => 'Lorem ipsum dolor sit amet',
                'staff_id' => 'Lorem ipsum dolor ',
                'phone_no' => 'Lorem ipsum dolor ',
            ],
        ];
        parent::init();
    }
}
