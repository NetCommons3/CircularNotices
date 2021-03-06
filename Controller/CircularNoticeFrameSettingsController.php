<?php
/**
 * CircularNoticeFrameSettings Controller
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Hirohisa Kuwata <Kuwata.Hirohisa@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('CircularNoticesAppController', 'CircularNotices.Controller');

/**
 * CircularNoticeFrameSettings Controller
 *
 * @author Hirohisa Kuwata <Kuwata.Hirohisa@withone.co.jp>
 * @package NetCommons\CircularNotices\Controller
 */
class CircularNoticeFrameSettingsController extends CircularNoticesAppController {

/**
 * layout
 *
 * @var array
 */
	public $layout = 'NetCommons.setting';

/**
 * use models
 *
 * @var array
 */
	public $uses = array(
		'Blocks.Block',
		'Frames.Frame',
		'CircularNotices.CircularNoticeFrameSetting',
	);

/**
 * use components
 *
 * @var array
 */
	public $components = array(
		'NetCommons.Permission' => array(
			//アクセスの権限
			'allow' => array(
				'edit' => 'page_editable',
			),
		),
	);

/**
 * use helpers
 *
 * @var array
 */
	public $helpers = array(
		'Blocks.BlockTabs' => array(
			'mainTabs' => array('role_permissions', 'frame_settings', 'mail_settings')
		),
		'NetCommons.DisplayNumber',
	);

/**
 * edit action
 *
 * @return void
 */
	public function edit() {
		if ($this->request->is(array('post', 'put'))) {
			$data = $this->request->data;
			if ($this->CircularNoticeFrameSetting->saveCircularNoticeFrameSetting($data)) {
				$this->redirect(NetCommonsUrl::backToPageUrl(true));
				return;
			}
			$this->NetCommons->handleValidationError($this->CircularNoticeFrameSetting->validationErrors);
		} else {
			$this->request->data = $this->CircularNoticeFrameSetting->getCircularNoticeFrameSetting(true);
			$this->request->data['Frame'] = Current::read('Frame');
		}

		$this->set('circularNoticeFrameSetting', $this->request->data['CircularNoticeFrameSetting']);
	}
}
