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

if (! $editModel) {
	$editModel = 'edit.data.Comment.comment';
}

$statusParams = h($statusModel) . ', ' . h($editStatusModel);
$formParams = h($formName) . ', ' . $statusParams;
?>

<div class="row">
	<div class="col-xs-offset-1 col-xs-11">
		<div class="form-group has-feedback"
				ng-class="comments.input.class(<?php echo $formParams; ?>)">

			<?php echo $this->Form->label('Comment.comment',
						'<span class="glyphicon glyphicon-comment"></span> ' .
							__d('net_commons', 'Comments to the person in charge.'),
						array('class' => 'control-label')
					); ?>

			<?php echo $this->Form->input('Comment.comment', array(
							'label' => false,
							'rows' => '2',
							'type' => 'textarea',
							'class' => 'form-control nc-noresize',
							'ng-model' => h($editModel),
							'ng-init' => "placeholder = " .
										"'" . __d('net_commons', 'Please enter comments to the person in charge.') . "'" .
										" + (" . h($statusModel) . " === '" . NetCommonsBlockComponent::STATUS_APPROVED . "'" .
											" ? '" . __d('net_commons', 'If it is not approved, input required.') . "' : '')",
							'placeholder' => '{{placeholder}}',
							'autofocus' => 'true',
							'ng-required' => "(" . h($editStatusModel) . " === '" . NetCommonsBlockComponent::STATUS_DISAPPROVED . "')",
						)
					); ?>

			<div class="form-control-feedback"
					ng-class="comments.input.glyphicon(<?php echo $formParams; ?>)"
					ng-show="comments.input.hasErrorTarget(<?php echo $statusParams; ?>)">
			</div>

			<div class="help-block">
				<br ng-hide="comments.input.showMessage(<?php echo $formParams; ?>)" />
				<div ng-show="comments.input.showMessage(<?php echo $formParams; ?>)">
					<?php echo __d('net_commons', 'If it is not approved, comment is a required input.'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
