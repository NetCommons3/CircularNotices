<?php
/**
 * View/CircularNoticeMailSettings/editのテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuna Miyashita <butackle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
App::uses('NetCommonsControllerTestCase', 'NetCommons.TestSuite');
App::uses('BlockTabsHelper', 'Blocks.View/Helper');
App::uses('BlockRolePermissionFormHelper', 'Blocks.View/Helper');
App::uses('MailSetting', 'Mails.Model');

/**
 * View/CircularNoticeMailSettings/editのテスト
 *
 * @author Yuna Miyashita <butackle@gmail.com>
 * @package NetCommons\CircularNotices\Test\Case\View\CircularNoticeMailSettings\EditTest
 */
class CircularNoticeMailSettingsViewEditTest extends NetCommonsControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.circular_notices.circular_notice_frame_setting',
		'plugin.mails.mail_setting_fixed_phrase',
	);

/**
 * Plugin name
 *
 * @var string
 */
	public $plugin = 'circular_notices';

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		//テストプラグインのロード
		NetCommonsCakeTestCase::loadTestPlugin($this, 'CircularNotices', 'TestCircularNotices');
		//テストコントローラ生成
		$this->generateNc('TestCircularNotices.TestViewElementsCircularNoticeFrameSettingsEditForm');
	}

/**
 * View/CircularNoticeMailSettings/editのテスト
 *
 * @return void
 */
	public function testEdit() {
		$this->controller->set('roles', []);
		$View = new View($this->controller);
		$View->viewVars['settingTabs'] = [];
		$View->BlockTabs = new BlockTabsHelper($View);
		$View->BlockRolePermissionForm = new BlockRolePermissionFormHelper($View);

		$View->render('CircularNotices.CircularNoticeMailSettings/edit');
	}
}