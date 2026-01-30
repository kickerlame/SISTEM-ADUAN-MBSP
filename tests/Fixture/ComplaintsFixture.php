<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ComplaintsFixture
 */
class ComplaintsFixture extends TestFixture
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
                'complaint_id' => 1,
                'complaint_no' => 'Lorem ipsum dolor sit amet',
                'complainant_id' => 1,
                'category_id' => 1,
                'status_id' => 1,
                'priority_id' => 1,
                'officer_id' => 1,
                'location_address' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'district' => 'Lorem ipsum dolor sit amet',
                'details' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'latitude' => 1.5,
                'longitude' => 1.5,
                'is_validated' => 1,
                'deadline_at' => '2026-01-17 19:24:43',
                'created_at' => 1768677883,
                'updated_at' => 1768677883,
            ],
        ];
        parent::init();
    }
}
