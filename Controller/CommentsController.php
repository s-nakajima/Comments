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
}
