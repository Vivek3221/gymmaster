<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BodiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BodiesTable Test Case
 */
class BodiesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BodiesTable
     */
    public $Bodies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.bodies',
        'app.exercise'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Bodies') ? [] : ['className' => BodiesTable::class];
        $this->Bodies = TableRegistry::get('Bodies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Bodies);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
