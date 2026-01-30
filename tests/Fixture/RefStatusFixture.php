<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RefStatusFixture
 */
class RefStatusFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'ref_status';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'status_id' => 1,
                'status_name' => 'Lorem ipsum dolor sit amet',
                'status_color' => 'Lorem',
            ],
        ];
        parent::init();
    }
}
