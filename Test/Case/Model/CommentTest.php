<?php
/**
 * Comment Test Case
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('Comment', 'Comments.Model');

/**
 * Comment Test Case
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Comments\Test\Case\Model
 */
class CommentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.comments.comment',
		'plugin.comments.user_attributes_user',
		'plugin.m17n.language',
		'plugin.m17n.languages_page',
		'plugin.users.user',
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Comment = ClassRegistry::init('Comments.Comment');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Comment);

		parent::tearDown();
	}

/**
 * testCreateSave
 *
 * @return  void
 */
	public function testSave() {
		CakeSession::write('Auth.User.id', 1);

		$comment['Comment'] = array(
			'plugin_key' => 'comments',
			'content_key' => 'content',
			'comment' => 'testSave',
		);
		$result = $this->Comment->save($comment);

		$this->assertArrayHasKey('Comment', $result, print_r($result, true));
		$this->assertArrayHasKey('id', $result['Comment'], print_r($result, true));
		$this->assertArrayHasKey('plugin_key', $result['Comment'], print_r($result, true));
		$this->assertArrayHasKey('content_key', $result['Comment'], print_r($result, true));
		$this->assertArrayHasKey('comment', $result['Comment'], print_r($result, true));

		CakeSession::write('Auth.User.id', null);
	}

}
