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

<div nc-workflow-form="<?php echo h($formName); ?>"
	nc-message-error-required="<?php echo h(__d('net_commons', 'If it is not approved, comment is a required input.')); ?>"
	nc-message-placeholder="<?php echo h(__d('net_commons', 'Please enter comments to the person in charge.')); ?>"
	nc-message-placeholder-approved="<?php echo h(__d('net_commons', 'If it is not approved, input required.')); ?>"
	nc-message-label="<?php echo __d('net_commons', 'Comments to the person in charge.'); ?>">

</div>
