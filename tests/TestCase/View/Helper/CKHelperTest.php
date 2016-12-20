<?php
namespace CkEditor\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use CkEditor\View\Helper\CkHelper;

/**
 * CkEditor\View\Helper\CKHelper Test Case
 */
class CKHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \CkEditor\View\Helper\CKHelper
     */
    public $CKHelper;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Ck = new CkHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Ck);

        parent::tearDown();
    }

    /**
     * Test input
     *
     * @return void
     */
    public function testInput()
    {
        // Test 1 - the standard set up
        $result = $this->Ck->input('content');

        $this->assertContains('<script src="//cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>', $result);
        $this->assertContains('<label for="content">Content</label>', $result);
        $this->assertContains('<textarea name="content" id="content" rows="5"></textarea>', $result);
        $this->assertContains('<script type="text/javascript">CKEDITOR.replace(\'content\');</script>', $result);

        // Test 2 - associated model
        $result = $this->Ck->input('category.description');

        $this->assertContains('<div class="input textarea"><label for="category-description">Description</label><textarea name="category[description]" id="category-description" rows="5"></textarea></div>', $result);
        $this->assertContains('<script type="text/javascript">CKEDITOR.replace(\'category.description\');</script>', $result);

        // Test 3 - a unique label
        $result = $this->Ck->input('content', ['label' => 'A Unique Label']);

        $this->assertContains('<label for="content">A Unique Label</label>', $result);
        $this->assertContains('<textarea name="content" id="content" rows="5"></textarea>', $result);
        $this->assertContains('<script type="text/javascript">CKEDITOR.replace(\'content\');</script>', $result);

        // Test 4 - custom CKEditor options
        $result = $this->Ck->input('brief', [], ['fullPage' => true, 'allowedContent' => 'true']);

        $this->assertContains('<script type="text/javascript">CKEDITOR.replace(\'brief\', {\'fullPage\' : \'1\',\'allowedContent\' : \'true\',});</script>', $result);

        // Test 5 - a custom CKEditor path
        $result = $this->Ck->input('content', [], [], '/js/ckeditor.js');

        $this->assertContains('<script src="/js/ckeditor.js"></script>', $result);

        // Test 6 - full options
        $result = $this->Ck->input('description', ['label' => 'A unique label'], ['fullPage' => true, 'allowedContent' => 'true'], '/js/scripts/ckeditor.js');

        $this->assertContains('<script src="/js/scripts/ckeditor.js"></script>', $result);
        $this->assertContains('<div class="input textarea"><label for="description">A unique label</label><textarea name="description" id="description" rows="5"></textarea></div>', $result);
        $this->assertContains('<script type="text/javascript">CKEDITOR.replace(\'description\', {\'fullPage\' : \'1\',\'allowedContent\' : \'true\',});</script>', $result);
    }
}