<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExrciseDirectoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExrciseDirectoriesTable Test Case
 */
class ExrciseDirectoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ExrciseDirectoriesTable
     */
    public $ExrciseDirectories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.exrcise_directories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ExrciseDirectories') ? [] : ['className' => ExrciseDirectoriesTable::class];
        $this->ExrciseDirectories = TableRegistry::get('ExrciseDirectories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ExrciseDirectories);

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
