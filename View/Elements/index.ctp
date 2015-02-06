<?php
/**
 * comment index template
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('CommentsController', 'Comments.Controller');
?>

<?php if ($comments): ?>
<div class="panel panel-default">
	<div class="panel-body workflow-comments">
		<?php foreach ($comments as $i => $comment): ?>
		<div class="comment form-group <?php echo $i >= CommentsController::START_LIMIT ? 'hidden' : '' ?>">
			<div>
				<a href="" ng-click="user.showUser(<?php echo $comment['trackableCreator']['id'] ?>)">
					<b><?php echo $comment['trackableCreator']['username'] ?></b>
				</a>
				<small class="text-muted"><?php echo $comment['comment']['created'] ?></small>
			</div>
			<div>
				<?php echo nl2br($comment['comment']['comment']) ?>
			</div>
		</div>
		<?php endforeach ?>

		<div class="form-group">
			<button type="button" class="btn btn-info btn-block more  <?php echo $i < CommentsController::START_LIMIT ? 'hidden' : '' ?>"
					ng-click="workflow.more()">
				<?php echo h(__d('net_commons', 'More')); ?>
			</button>
		</div>
	</div>
</div>
<?php endif ?>
