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
			'content_key' => array(
				'notEmpty' => array(
					'rule' => array('notEmpty'),
					'message' => __d('net_commons', 'Invalid request.'),
					'required' => true,
				)
			),
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
 * before save
 *
 * @param array $options Options passed from Model::save().
 * @return bool True if the operation should continue, false if it should abort
 */
	public function beforeSave($options = array()) {
		if (! isset($this->data[$this->name]['id'])) {
			$this->data[$this->name]['created_user'] = CakeSession::read('Auth.User.id');
		}
		$this->data[$this->name]['modified_user'] = CakeSession::read('Auth.User.id');
		return true;
	}

/**
 * get content data
 *
 * @param array $query Option fields (conditions / fields / joins / limit / offset / order / page / group / callbacks)
 * @return array
 */
	public function getComments($conditions, $limit = 100) {
		return $this->find('all', array(
				'conditions' => $conditions,
				'limit' => $limit,
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

			$data['Comment']['plugin_key'] = strtolower(Inflector::pluralize($options['caller']));
			$data['Comment']['content_key'] = $data[$options['caller']]['key'];

			$this->set($data['Comment']);
			$this->validates();
		}

		return $this->validationErrors ? $this->validationErrors : true;
	}
}
