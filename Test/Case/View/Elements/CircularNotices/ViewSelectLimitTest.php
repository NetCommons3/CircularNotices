<?php
/**
 * View/Elements/CircularNotices/view_select_limitのテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsControllerTestCase', 'NetCommons.TestSuite');

/**
 * View/Elements/CircularNotices/view_select_limitのテスト
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\CircularNotices\Test\Case\View\Elements\CircularNotices\ViewSelectLimit
 */
class CircularNoticesViewElementsCircularNoticesViewSelectLimitTest extends NetCommonsControllerTestCase {

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
		$this->generateNc('TestCircularNotices.TestViewElementsCircularNoticesViewSelectLimit');
	}

/**
 * View/Elements/CircularNotices/view_select_limitのテスト
 *
 * @return void
 */
	public function testViewSelectLimit() {
		//テスト実行
		$this->_testGetAction('/test_circular_notices/test_view_elements_circular_notices_view_select_limit/view_select_limit',
				array('method' => 'assertNotEmpty'), null, 'view');

		//チェック
		$pattern = '/' . preg_quote('View/Elements/CircularNotices/view_select_limit', '/') . '/';
		$this->assertRegExp($pattern, $this->view);

		//TODO:必要に応じてassert追加する
	}

}