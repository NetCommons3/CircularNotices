<?php
/**
 * View/Elements/CircularNoticeFrameSettings/edit_formテスト用Controller
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('AppController', 'Controller');

/**
 * View/Elements/CircularNoticeFrameSettings/edit_formテスト用Controller
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\CircularNotices\Test\test_app\Plugin\TestCircularNotices\Controller
 */
class TestViewElementsCircularNoticeFrameSettingsEditFormController extends AppController {

/**
 * use helpers
 *
 * @var array
 */
	public $helpers = array(
		'Mails.MailsHtml',
		'Mails.MailForm',
		'NetCommons.DisplayNumber',
	);

/**
 * edit_form
 *
 * @return void
 */
	public function edit_form() {
		$this->autoRender = true;
	}

}
