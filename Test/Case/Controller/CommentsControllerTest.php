<?php
/**
 * CommentsController Test Case
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('CommentsController', 'Comments.Controller');

/**
 * CommentsController Test Case
 */
class CommentsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'site_setting',
		'plugin.comments.comment',
		'plugin.comments.user_attributes_user',
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		Configure::write('Config.language', 'ja');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		Configure::write('Config.language', null);
		parent::tearDown();
	}

/**
 * testCommentsLastPage method
 *
 * @return void
 */
	public function testIndex() {
		$view = $this->testAction(
				'/comments/comments/index/test_plugin/test_contet',
				array(
					'method' => 'get',
					'return' => 'contents',
				)
			);
		$result = json_decode($view, true);

		$this->assertArrayHasKey('code', $result, print_r($result, true));
		$this->assertArrayHasKey('name', $result, print_r($result, true));
		$this->assertArrayHasKey('results', $result, print_r($result, true));
		$this->assertArrayHasKey('comments', $result['results'], print_r($result, true));
		$this->assertArrayHasKey('current', $result['results']['comments'], print_r($result, true));
		$this->assertArrayHasKey('hasPrev', $result['results']['comments'], print_r($result, true));
		$this->assertArrayHasKey('hasNext', $result['results']['comments'], print_r($result, true));
		$this->assertArrayHasKey('data', $result['results']['comments'], print_r($result, true));

		$this->assertCount(1, $result['results']['comments']['data'], print_r($result, true));
	}

/**
 * testCommentsLastPage method
 *
 * @return void
 */
	public function testIndexPaging() {


		$view = $this->testAction(
				'/comments/comments/index/test_plugin/test_contet_paging/page:1',
				array(
					'method' => 'get',
					'return' => 'contents',
				)
			);
		$result = json_decode($view, true);

		$this->assertArrayHasKey('code', $result, print_r($result, true));
		$this->assertArrayHasKey('name', $result, print_r($result, true));
		$this->assertArrayHasKey('results', $result, print_r($result, true));
		$this->assertArrayHasKey('comments', $result['results'], print_r($result, true));
		$this->assertArrayHasKey('current', $result['results']['comments'], print_r($result, true));
		$this->assertArrayHasKey('hasPrev', $result['results']['comments'], print_r($result, true));
		$this->assertArrayHasKey('hasNext', $result['results']['comments'], print_r($result, true));
		$this->assertArrayHasKey('data', $result['results']['comments'], print_r($result, true));

		$comments = $result['results']['comments']['data'];
		$this->assertCount(100, $comments, print_r(count($comments), true));
	}

}
