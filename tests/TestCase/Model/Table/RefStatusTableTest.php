<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RefStatusTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RefStatusTable Test Case
 */
class RefStatusTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RefStatusTable
     */
    protected $RefStatus;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.RefStatus',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('RefStatus') ? [] : ['className' => RefStatusTable::class];
        $this->RefStatus = $this->getTableLocator()->get('RefStatus', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->RefStatus);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\RefStatusTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
