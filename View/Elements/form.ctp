<?php
/**
 * announcements comment form element template
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<div class="row">
	<div class="col-xs-offset-1 col-xs-11">
		<div class="form-group has-feedback">

			<label class="control-label" for="CommentComment">
				<span class="glyphicon glyphicon-comment"></span>
				<?php echo __d('net_commons', 'Comments to the person in charge.') ?>
			</label>

			<div class="input textarea">
				<?php echo $this->Form->textarea(
					'Comment.comment',
					array(
						'class' => 'form-control nc-noresize',
						'label' => __d('net_commons', 'Comments to the person in charge.'),
						'placeholder' => ($contentPublishable && $contentStatus === NetCommonsBlockComponent::STATUS_APPROVED) ? __d('net_commons', 'If it is not approved, comment is a required input.') : __d('net_commons', 'Please enter comments to the person in charge.'),
						'rows' => 2,
					)) ?>
			</div>
		</div>

		<?php echo $this->element(
			'NetCommons.errors', [
				'errors' => $this->validationErrors,
				'model' => 'Comment',
				'field' => 'comment',
			]) ?>
	</div>
</div>
