<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FitnessTestsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FitnessTestsTable Test Case
 */
class FitnessTestsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FitnessTestsTable
     */
    public $FitnessTests;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.fitness_tests',
        'app.users',
        'app.exercises',
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
        $config = TableRegistry::exists('FitnessTests') ? [] : ['className' => FitnessTestsTable::class];
        $this->FitnessTests = TableRegistry::get('FitnessTests', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FitnessTests);

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
