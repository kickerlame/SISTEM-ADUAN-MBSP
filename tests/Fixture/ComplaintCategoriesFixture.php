<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ComplaintCategoriesFixture
 */
class ComplaintCategoriesFixture extends TestFixture
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
                'category_id' => 1,
                'department_id' => 1,
                'category_name' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
