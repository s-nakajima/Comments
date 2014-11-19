<?php
/**
 * Comments Controller
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('CommentsAppController', 'Comments.Controller');

/**
 * Comments Controller
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Comments\Controller
 */
class CommentsController extends CommentsAppController {

/**
 * start limit
 *
 * @var int
 */
	const START_LIMIT = 5;

/**
 * max limit
 *
 * @var int
 */
	const MAX_LIMIT = 100;

/**
 * use model
 *
 * @var array
 */
	public $uses = array(
		'Comments.Comment',
	);

/**
 * use component
 *
 * @var array
 */
	public $components = array(
		'Paginator'
	);

/**
 * beforeFilter
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
	}

/**
 * index method
 *
 * @param string $pluginKey comments.plugin_key
 * @param string $contentKey comments.content_key
 * @return CakeResponse A response object containing the rendered view.
 */
	public function index($pluginKey, $contentKey) {
		$limit = $this::START_LIMIT;

		//コメントデータを取得
		$this->Paginator->settings = array(
			'Comment' => array(
				'fields' => array(
					'Comment.id',
					'Comment.comment',
					'Comment.created_user',
					'Comment.created',
					'CreatedUser.key',
					'CreatedUser.value',
				),
				'conditions' => array(
					'Comment.plugin_key' => $pluginKey,
					'Comment.content_key' => $contentKey,
				),
				'limit' => $limit,
				'order' => 'Comment.id DESC',
			),
			'CreatedUser' => array(
				'conditions' => array(
					'Comment.created_user = CreatedUser.user_id',
					'CreatedUser.language_id' => 2, //TODO:
					'CreatedUser.key' => 'nickname'
				)
			)
		);
		$comments = $this->Paginator->paginate('Comment');
//
//		$this->set('comments', $comments);
//		$this->set('limit', $limit);

		//renderの後、$this->Viewが使用可能になる
		$this->render(false);

		$result = array(
			'comments' => array(
				'data' => $comments,
				'current' => $this->View->Paginator->current(),
				'limit' => $limit,
				'hasPrev' => $this->View->Paginator->hasPrev(),
				'hasNext' => $this->View->Paginator->hasNext(),
			)
		);
//		var_dump($result);
		$this->set(compact('result'));
		$this->set('_serialize', 'result');

		$this->layout = false;
		$this->view = null;
	}
}
