<?php
/**
 * circular notice index template
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Hirohisa Kuwata <Kuwata.Hirohisa@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<?php
	echo $this->NetCommonsHtml->script(
		array(
			'/circular_notices/js/circular_notices.js'
		),
		array(
			'plugin' => false,
			'once' => true,
			'inline' => false
		)
	);
?>

<?php
	echo $this->NetCommonsHtml->css(
		array(
			'/circular_notices/css/circular_notices.css'
		),
		array(
			'plugin' => false,
			'once' => true,
			'inline' => false
		)
	);
?>

<div class="nc-content-list">

	<?php if (Current::permission('content_creatable')) : ?>
		<div class="clearfix">
			<div class="pull-right">
				<span class="nc-tooltip" tooltip="<?php echo h(__d('net_commons', 'Add')); ?>">
					<?php
					$addUrl = $this->NetCommonsHtml->url(array(
						'controller' => 'circular_notices',
						'action' => 'add',
						'frame_id' => Current::read('Frame.id')
					));
					echo $this->Button->addLink('',
						$addUrl,
						array('tooltip' => __d('net_commons', 'Add')));
					?>

				</span>
			</div>
		</div>

		<hr class="circular-notice-spacer" />
	<?php endif; ?>

	<div class="clearfix">
		<div class="pull-left">
			<?php echo $this->element('CircularNotices/select_status'); ?>
		</div>
		<div class="pull-right">
			<?php echo $this->element('CircularNotices/select_sort'); ?>
			<?php echo $this->element('CircularNotices/select_limit'); ?>
		</div>
	</div>

	<hr />

	<?php if ($circularNoticeContents) : ?>
		<?php foreach ($circularNoticeContents as $circularNoticeContent) : ?>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="clearfix">
						<div class="pull-left circular-notice-index-status-label">
							<?php echo $this->element('CircularNotices/status_label', array('circularNoticeContent' => $circularNoticeContent)); ?>
						</div>
						<div class="pull-left">
							<?php if (
								$circularNoticeContent['circularNoticeContent']['currentStatus'] == CircularNoticeComponent::CIRCULAR_NOTICE_CONTENT_STATUS_IN_DRAFT ||
								$circularNoticeContent['circularNoticeContent']['currentStatus'] == CircularNoticeComponent::CIRCULAR_NOTICE_CONTENT_STATUS_RESERVED
							) : ?>
								<?php echo h($circularNoticeContent['circularNoticeContent']['subject']); ?><br />
							<?php else : ?>
								<?php echo $this->Html->link(
									$circularNoticeContent['circularNoticeContent']['subject'],
									$this->NetCommonsHtml->url(
										array(
											'controller' => 'circular_notices',
											'action' => 'view' . '/' . $frameId,
											'key' => $circularNoticeContent['circularNoticeContent']['key']
										)
									)
								);
								?>
							<?php endif; ?>
							<small>
								<?php echo h(__d('circular_notices', 'Circular Content Period Title')); ?>
								<?php echo $this->Date->dateFormat($circularNoticeContent['circularNoticeContent']['openedPeriodFrom']); ?>
								～
								<?php echo $this->Date->dateFormat($circularNoticeContent['circularNoticeContent']['openedPeriodTo']); ?>
							</small>
						</div>
						<div class="pull-right">
							<small>
								<?php echo h(__d('circular_notices', 'Read Count Title') . ' ' . h($circularNoticeContent['readCount'])); ?>
								/
								<?php echo h($circularNoticeContent['targetCount']); ?><br />
								<?php echo h(__d('circular_notices', 'Reply Count Title') . ' ' . h($circularNoticeContent['replyCount'])); ?>
								/
								<?php echo h($circularNoticeContent['targetCount']); ?>
							</small>
						</div>
					</div>
					<?php if ($contentCreatable && $circularNoticeContent['circularNoticeContent']['createdUser'] == $userId) : ?>
						<div>
							<hr />
							<div class="pull-right">
								<span class="nc-tooltip" tooltip="<?php echo h(__d('net_commons', 'Edit')); ?>">
									<a href="<?php echo $this->Html->url('/circular_notices/circular_notices/edit/' . $frameId . '/' . $circularNoticeContent['circularNoticeContent']['id']) ?>" class="btn btn-sm btn-primary">
										<span class="glyphicon glyphicon-edit"> </span>
									</a>
								</span>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>

		<div class="text-center">
			<?php echo $this->element('NetCommons.paginator', array(
				'url' => Hash::merge(
					array('controller' => 'circular_notices', 'action' => 'index', $frameId),
					$this->Paginator->params['named']
				)
			)); ?>
		</div>

	<?php else : ?>
		<?php echo h(__d('circular_notices', 'Circular Content Data Not Found')); ?>
	<?php endif; ?>

</div>
