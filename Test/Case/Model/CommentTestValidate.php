<?php
/**
 * Test Case of Comment->getComments()
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('CommentTest', 'Comments.Test/Case/Model');

/**
 * Test Case of Comment->getComments()
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Comments\Test\Case\Model
 */
class CommentTestValidate extends CommentTest {

/**
 * Expect Comment->validateByStatus().
 *   Test case status=NetCommonsBlockComponent::STATUS_PUBLISHED
 *
 * @return  void
 */
	public function test() {
		//テストデータ生成
		$data = array(
			'TestContet' => array(
				'status' => NetCommonsBlockComponent::STATUS_PUBLISHED,
				'key' => 'test_content'
			),
			'Comment' => array(
				'comment' => 'Add comment',
			),
		);
		$options = array(
			'plugin' => 'test_plugin',
			'caller' => 'TestContet'
		);

		//テスト実行
		$result = $this->Comment->validateByStatus($data, $options);

		//チェック
		$this->assertTrue($result);
	}

/**
 * Expect Comment->validateByStatus().
 *   Test case comment empty
 *
 * @return  void
 */
	public function testCommentEmpty() {
		//テストデータ生成
		$data = array(
			'TestContet' => array(
				'status' => NetCommonsBlockComponent::STATUS_PUBLISHED,
				'key' => 'test_content'
			),
			'Comment' => array(
				'comment' => '',
			),
		);
		$options = array(
			'plugin' => 'test_plugin',
			'caller' => 'TestContet'
		);

		//テスト実行
		$result = $this->Comment->validateByStatus($data, $options);

		//チェック
		$this->assertTrue($result);
	}

/**
 * Expect Comment->validateByStatus().
 *   Test case status NetCommonsBlockComponent::STATUS_DISAPPROVED and comment empty
 *
 * @return  void
 */
	public function testDisapprovedCommentEmpty() {
		//テストデータ生成
		$data = array(
			'TestContet' => array(
				'status' => NetCommonsBlockComponent::STATUS_DISAPPROVED,
				'key' => 'test_content'
			),
			'Comment' => array(
				'comment' => '',
			),
		);
		$options = array(
			'plugin' => 'test_plugin',
			'caller' => 'TestContet'
		);

		//テスト実行
		$result = $this->Comment->validateByStatus($data, $options);

		//チェック
		$this->assertFalse($result);
	}

/**
 * Expect Comment->validateByStatus().
 *   Test case omission of plugin
 *
 * @return  void
 */
	public function testOmissionOfPlugin() {
		//テストデータ生成
		$data = array(
			'TestContet' => array(
				'status' => NetCommonsBlockComponent::STATUS_PUBLISHED,
				'key' => 'test_content'
			),
			'Comment' => array(
				'comment' => 'Add comment',
			),
		);
		$options = array(
			'caller' => 'TestContet'
		);

		//テスト実行
		$result = $this->Comment->validateByStatus($data, $options);

		//チェック
		$this->assertTrue($result);
		$this->assertTextEquals('testcontets', $this->Comment->data['Comment']['plugin_key']);
	}

}
