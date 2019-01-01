<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DietsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DietsTable Test Case
 */
class DietsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DietsTable
     */
    public $Diets;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.diets',
        'app.users',
        'app.partners'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Diets') ? [] : ['className' => DietsTable::class];
        $this->Diets = TableRegistry::get('Diets', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Diets);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
