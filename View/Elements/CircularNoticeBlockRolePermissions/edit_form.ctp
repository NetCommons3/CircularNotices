<?php
/**
 * circular notice block role permissions edit form element
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Hirohisa Kuwata <Kuwata.Hirohisa@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<?php echo $this->Form->hidden('Block.id', array(
		'value' => $blockId,
	)); ?>

<?php echo $this->Form->hidden('CircularNoticeSetting.id', array(
		'value' => isset($circularNoticeSetting['id']) ? (int)$circularNoticeSetting['id'] : null,
	)); ?>

<?php echo $this->Form->hidden('CircularNoticeSetting.key', array(
		'value' => isset($circularNoticeSetting['key']) ? $circularNoticeSetting['key'] : null,
	)); ?>

<?php //echo $this->element('Blocks.block_role_setting', array(
//		'roles' => $roles,
//		'model' => 'CircularNoticeSetting',
//		'creatablePermissions' => array(
//			'contentCreatable' => __d('blocks', 'Content creatable roles'),
//		),
//		'options' => null,
//	));
//?>

<?php echo $this->element('Blocks.block_creatable_setting', array(
	'settingPermissions' => array(
		'content_creatable' => __d('blocks', 'Content creatable roles'),
//		'content_comment_creatable' => __d('blocks', 'Content comment creatable roles'),
	),
)); ?>


<!-- メール設定 -->
<div>
	<div class="panel panel-default">
		<div class="panel-heading">
			メール設定
		</div>

		<div class="panel-body">
			TODO メールの件名と本文を設定
		</div>
	</div>
</div>

