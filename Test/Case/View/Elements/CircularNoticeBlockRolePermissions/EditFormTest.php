<?php
/**
 * View/Elements/CircularNoticeBlockRolePermissions/edit_formのテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsControllerTestCase', 'NetCommons.TestSuite');

/**
 * View/Elements/CircularNoticeBlockRolePermissions/edit_formのテスト
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\CircularNotices\Test\Case\View\Elements\CircularNoticeBlockRolePermissions\EditForm
 */
class CircularNoticesViewElementsCircularNoticeBlockRolePermissionsEditFormTest extends NetCommonsControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array();

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
		$this->generateNc('TestCircularNotices.TestViewElementsCircularNoticeBlockRolePermissionsEditForm');
	}

/**
 * View/Elements/CircularNoticeBlockRolePermissions/edit_formのテスト
 *
 * @return void
 */
	public function testEditForm() {
		$this->controller->helpers = array(
			'Blocks.BlockRolePermissionForm',
		);
		$this->controller->set('blockId', 1);
		$this->controller->set('roles', array(1, 2, 3));

		//テスト実行
		$this->_testGetAction('/test_circular_notices/test_view_elements_circular_notice_block_role_permissions_edit_form/edit_form',
				array('method' => 'assertNotEmpty'), null, 'view');

		//チェック
		$pattern = '/' . preg_quote('View/Elements/CircularNoticeBlockRolePermissions/edit_form', '/') . '/';
		$this->assertRegExp($pattern, $this->view);
	}
}
