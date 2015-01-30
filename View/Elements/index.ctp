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
var_dump($comments);
?>

<div class="panel panel-default">
	<div class="panel-body">
		<?php foreach ($comments as $comment): ?>
		<div>
			<div ng-hide="$first"><hr /></div>
			<div>
				<a href="" ng-click="user.showUser(<?php echo $comment['trackableCreator']['id'] ?>)">
					<b><?php echo $comment['trackableCreator']['username'] ?></b>
				</a>
				<small class="text-muted"><?php echo $comment['comment']['created'] ?></small>
			</div>
			<div>
				<?php echo $comment['comment']['comment'] ?>
			</div>
		</div>
		<?php endforeach ?>

		<hr />

		<button type="button" class="btn btn-default btn-block"
				ng-show="workflow.comments.hasNext"
				ng-click="workflow.get(workflow.current + 1)">

			{{messages.more}}
		</button>

	</div>
</div>

<div nc-workflow-index
	 nc-message-more="<?php echo h(__d('net_commons', 'More')); ?>">

</div>
