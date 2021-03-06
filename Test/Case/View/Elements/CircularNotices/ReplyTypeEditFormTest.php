<?php
/**
 * View/Elements/CircularNotices/reply_type_edit_formのテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsControllerTestCase', 'NetCommons.TestSuite');
App::uses('CircularNoticeContent', 'CircularNotices.Model');

/**
 * View/Elements/CircularNotices/reply_type_edit_formのテスト
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\CircularNotices\Test\Case\View\Elements\CircularNotices\ReplyTypeEditForm
 */
class CircularNoticesViewElementsCircularNoticesReplyTypeEditFormTest extends NetCommonsControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.circular_notices.circular_notice_content',
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
		$this->generateNc('TestCircularNotices.TestViewElementsCircularNoticesReplyTypeEditForm');
	}

/**
 * View/Elements/CircularNotices/reply_type_edit_formのテスト
 *
 * @return void
 */
	public function testReplyTypeEditForm() {
		if (!class_exists('CircularNoticeContent')) {
			App::load('CircularNoticeContent');
		}

		$this->controller->set('circularNoticeChoice', array(1, 2, 3));

		//テスト実行
		$this->_testGetAction('/test_circular_notices/test_view_elements_circular_notices_reply_type_edit_form/reply_type_edit_form',
				array('method' => 'assertNotEmpty'), null, 'view');

		//チェック
		$pattern = '/' . preg_quote('View/Elements/CircularNotices/reply_type_edit_form', '/') . '/';
		$this->assertRegExp($pattern, $this->view);
	}
}
