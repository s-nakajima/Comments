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
 * use model
 *
 * @var array
 */
	//public $uses = array();

/**
 * use component
 *
 * @var array
 */
	//public $components = array();

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
 * @return CakeResponse A response object containing the rendered view.
 */
	public function index($pluginKey, $contentKey) {
		return $this->render('Comments/index');
	}
}
