<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FitnessMesermentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FitnessMesermentsTable Test Case
 */
class FitnessMesermentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FitnessMesermentsTable
     */
    public $FitnessMeserments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.fitness_meserments',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('FitnessMeserments') ? [] : ['className' => FitnessMesermentsTable::class];
        $this->FitnessMeserments = TableRegistry::get('FitnessMeserments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FitnessMeserments);

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
