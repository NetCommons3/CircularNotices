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
		)
	);
?>

<?php
	echo $this->NetCommonsHtml->css(
		array(
			'/circular_notices/css/circular_notices.css'
		)
	);
?>

<article class="index nc-content-list">

	<div class="clearfix circular-notices-navigation-header">
		<?php if (Current::permission('content_creatable')) : ?>
			<div class="pull-right">
				<?php
				$addUrl = array(
					'controller' => 'circular_notices',
					'action' => 'add',
					'frame_id' => Current::read('Frame.id')
				);
				echo $this->Button->addLink('',
					$addUrl,
					array('tooltip' => __d('net_commons', 'Add')));
				?>
			</div>
		<?php endif; ?>
		<div class="pull-left">
			<?php echo $this->element('CircularNotices/select_content_status'); ?>
			<?php echo $this->element('CircularNotices/select_reply_status'); ?>
			<?php echo $this->element('CircularNotices/select_sort'); ?>
			<?php echo $this->DisplayNumber->dropDownToggle(); ?>
		</div>
	</div>

		<?php if ($circularNoticeContents) : ?>
			<?php foreach ($circularNoticeContents as $circularNoticeContent) : ?>
				<!-- タイトル -->
				<h2 class="circular-notices-word-break">
					<?php echo $this->TitleIcon->titleIcon(h($circularNoticeContent['CircularNoticeContent']['title_icon'])); ?>

					<?php if (
						($circularNoticeContent['CircularNoticeContent']['content_status'] == CircularNoticeComponent::CIRCULAR_NOTICE_CONTENT_STATUS_IN_DRAFT
							|| $circularNoticeContent['CircularNoticeContent']['content_status'] == CircularNoticeComponent::CIRCULAR_NOTICE_CONTENT_STATUS_RESERVED)
						&& !$this->Workflow->canEdit('CircularNotices.CircularNoticeContent', $circularNoticeContent)
					) : ?>
						<?php echo h($circularNoticeContent['CircularNoticeContent']['subject']); ?><br />
					<?php else : ?>
						<?php echo $this->NetCommonsHtml->link(
							$circularNoticeContent['CircularNoticeContent']['subject'],
							array(
								'controller' => 'circular_notices',
								'action' => 'view',
								'key' => $circularNoticeContent['CircularNoticeContent']['key']
							)
						);
						?>
					<?php endif; ?>

					<!-- ステータス -->
					<?php echo $this->element('CircularNotices/status_label', array(
						'circularNoticeContent' => $circularNoticeContent['CircularNoticeContent'])
					); ?>

					<!-- 回答期限 -->
					<?php if ($circularNoticeContent['CircularNoticeContent']['use_reply_deadline']): ?>
						<br />
						<small>
						<?php echo __d('circular_notices', 'Circular Content Deadline Title'); ?>
						<?php echo $this->CircularNotice->displayDate($circularNoticeContent['CircularNoticeContent']['reply_deadline']); ?>
						</small>
					<?php endif; ?>
				</h2>
				<article class="circular-notices">
					<div>
						<div class="well well-sm">
							<!-- 編集リンク -->
							<?php if (Current::permission('content_creatable')
								&& ($circularNoticeContent['CircularNoticeContent']['created_user'] == Current::read('User.id')
									|| Current::read('Permission.content_editable.role_key') === Role::ROOM_ROLE_KEY_ROOM_ADMINISTRATOR)) : ?>
								<div class="pull-right circular-notice-edit-link">
									<span class="nc-tooltip" tooltip="<?php echo __d('net_commons', 'Edit'); ?>">
										<?php echo $this->LinkButton->edit('',
											array(
												'controller' => 'circular_notices',
												'action' => 'edit',
												'key' => $circularNoticeContent['CircularNoticeContent']['key']
											)
										);
										?>
									</span>
								</div>
							<?php endif; ?>
							<!-- 閲覧状況・回答状況 -->
							<div class="pull-right circular-notice-answer-status">
								<small>
									<?php echo __d('circular_notices', 'Read Count Title'); ?>
									<span class="circular-notices-answer-count-molecule">
										<?php echo $circularNoticeContent['read_count']; ?>
									</span>
									<?php echo __d('circular_notices', 'Division bar'); ?>
									<span>
										<?php echo $circularNoticeContent['target_count']; ?>
									</span>
									<br />
									<?php echo __d('circular_notices', 'Reply Count Title'); ?>
									<span class="circular-notices-answer-count-molecule">
										<?php echo $circularNoticeContent['reply_count']; ?>
									</span>
									<?php echo __d('circular_notices', 'Division bar'); ?>
									<span>
										<?php echo $circularNoticeContent['target_count']; ?>
									</span>
								</small>
							</div>

							<!-- 回覧期間 -->
							<div class="circular-notice-attr-font">
								<div class="circular-notice-publish-period">
									<?php echo __d('circular_notices', 'Circular Content Period Title');?>
									<?php 
									if (! $circularNoticeContent['CircularNoticeContent']['publish_start']
											&& ! $circularNoticeContent['CircularNoticeContent']['publish_end']) {
										echo __d('circular_notices', 'Unset');
									} else {
										echo $this->CircularNotice->displayDate($circularNoticeContent['CircularNoticeContent']['publish_start']);
										echo __d('circular_notices', 'Till');
										echo $this->CircularNotice->displayDate($circularNoticeContent['CircularNoticeContent']['publish_end']);
									}
									?>
								</div>

								<!-- 作成者 -->
								<div class="circular-notice-created-user">
									<?php echo __d('circular_notices', 'Created User Title'); ?>
									<?php echo $this->NetCommonsHtml->handleLink($circularNoticeContent, array('avatar' => true)); ?>&nbsp;
								</div>
							</div>
						</div>
					</div>
				</article>
			<?php endforeach; ?>

			<?php echo $this->element('NetCommons.paginator'); ?>

		<?php else : ?>
			<p class="nc-not-found">
				<?php echo __d('circular_notices', 'Circular Content Data Not Found'); ?>
			</p>
		<?php endif; ?>
</article>
