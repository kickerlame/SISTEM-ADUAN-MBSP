<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ComplaintLogsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ComplaintLogsTable Test Case
 */
class ComplaintLogsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ComplaintLogsTable
     */
    protected $ComplaintLogs;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.ComplaintLogs',
        'app.Complaints',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ComplaintLogs') ? [] : ['className' => ComplaintLogsTable::class];
        $this->ComplaintLogs = $this->getTableLocator()->get('ComplaintLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ComplaintLogs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\ComplaintLogsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\ComplaintLogsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
