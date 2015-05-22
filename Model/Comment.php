<?php
/**
 * Comment Model
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('CommentsAppModel', 'Comments.Model');

/**
 * Comment Model
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Comments\Model
 */
class Comment extends CommentsAppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array();

/**
 * Called during validation operations, before validation. Please note that custom
 * validation rules can be defined in $validate.
 *
 * @param array $options Options passed from Model::save().
 * @return bool True if validate operation should continue, false to abort
 * @link http://book.cakephp.org/2.0/en/models/callback-methods.html#beforevalidate
 * @see Model::save()
 */
	public function beforeValidate($options = array()) {
		$this->validate = array(
			'plugin_key' => array(
				'notEmpty' => array(
					'rule' => array('notEmpty'),
					'message' => __d('net_commons', 'Invalid request.'),
					'required' => true,
				)
			),
			//'content_key' => array(
			//	'notEmpty' => array(
			//		'rule' => array('notEmpty'),
			//		'message' => __d('net_commons', 'Invalid request.'),
			//		'required' => true,
			//	)
			//),
			'comment' => array(
				'notEmpty' => array(
					'rule' => array('notEmpty'),
					'message' => __d('net_commons', 'If it is not approved, comment is a required input.'),
					'required' => true,
				)
			),
		);

		return parent::beforeValidate($options);
	}

/**
 * get content data
 *
 * @param array $conditions conditions
 * @return array
 */
	public function getComments($conditions) {
		return $this->find('all', array(
				'conditions' => $conditions,
				'order' => 'Comment.id DESC',
			)
		);
	}

/**
 * validate comment
 *
 * @param array $data received post data
 * @param array $options validation options
 * @return bool|array True on success, validation errors array on error
 */
	public function validateByStatus($data, $options) {
		//コメントの登録(ステータス 差し戻しのみコメント必須)
		if ($data[$options['caller']]['status'] === NetCommonsBlockComponent::STATUS_DISAPPROVED ||
				$data['Comment']['comment'] !== '') {

			$options['plugin'] = isset($options['plugin']) ? $options['plugin'] : $options['caller'];
			$data['Comment']['plugin_key'] = strtolower(Inflector::pluralize($options['plugin']));
			$data['Comment']['content_key'] = $data[$options['caller']]['key'];

			$this->set($data['Comment']);
			$this->validates();
		}

		return $this->validationErrors ? false : true;
	}

/**
 * Delete comments by blocks.key
 *
 * @param string $blockKey blocks.key
 * @return bool True on success
 * @throws InternalErrorException
 */
	public function deleteByBlock($blockKey) {
		if (! $this->deleteAll(array($this->alias . '.block_key' => $blockKey), false)) {
			throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
		}

		return true;
	}

}
