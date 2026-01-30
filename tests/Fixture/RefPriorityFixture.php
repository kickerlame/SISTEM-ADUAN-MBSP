<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RefPriorityFixture
 */
class RefPriorityFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'ref_priority';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'priority_id' => 1,
                'priority_label' => 'Lorem ipsum dolor ',
                'sla_hours' => 1,
            ],
        ];
        parent::init();
    }
}
