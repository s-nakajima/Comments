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
/* <div nc-workflow-form */
/* 	nc-message-error-required="<?php echo h(__d('net_commons', 'If it is not approved, comment is a required input.')); ?>" */
/* 	nc-message-placeholder="<?php echo h(__d('net_commons', 'Please enter comments to the person in charge.')); ?>" */
/* 	nc-message-placeholder-approved="<?php echo h(__d('net_commons', 'If it is not approved, input required.')); ?>" */
/* 	nc-message-label="<?php echo __d('net_commons', 'Comments to the person in charge.'); ?>"> */

/* </div> */
?>

<div class="row">
	<div class="col-xs-offset-1 col-xs-11" ng-init="workflow.input.init(form)">
		<div class="form-group has-feedback" ng-class="workflow.input.class()">

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
						'placeholder' => __d('net_commons', 'Please enter comments to the person in charge.'),
						'rows' => 2,
					)) ?>
			</div>

			<div class="form-control-feedback"
					ng-class="workflow.input.glyphicon()"
					ng-show="workflow.input.hasErrorTarget()">
			</div>

			<div class="help-block">
				<br ng-hide="workflow.input.showMessage()" />
				<div ng-repeat="errorMessage in workflow.input.getMessage()">
					{{errorMessage}}
				</div>
			</div>
		</div>
	</div>
</div>
