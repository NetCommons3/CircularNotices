<?php
/**
 * CircularNoticesAppController::initCircularNotice()テスト用Controller
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('CircularNoticesAppController', 'CircularNotices.Controller');

/**
 * CircularNoticesAppController::initCircularNotice()テスト用Controller
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\CircularNotices\Test\test_app\Plugin\TestCircularNotices\Controller
 */
class TestCircularNoticesAppControllerInitCircularNoticeController extends CircularNoticesAppController {

/**
 * initCircularNotice
 *
 * @return void
 */
	public function initCircularNotice() {
		$this->autoRender = true;
	}

}