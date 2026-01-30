<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RefPriorityTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RefPriorityTable Test Case
 */
class RefPriorityTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RefPriorityTable
     */
    protected $RefPriority;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.RefPriority',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('RefPriority') ? [] : ['className' => RefPriorityTable::class];
        $this->RefPriority = $this->getTableLocator()->get('RefPriority', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->RefPriority);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\RefPriorityTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
