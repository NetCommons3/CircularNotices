<?php
/**
 * CircularNoticeFrameSetting::getCircularNoticeFrameSetting()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsGetTest', 'NetCommons.TestSuite');

/**
 * CircularNoticeFrameSetting::getCircularNoticeFrameSetting()のテスト
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\CircularNotices\Test\Case\Model\CircularNoticeFrameSetting
 */
class CircularNoticeFrameSettingGetCircularNoticeFrameSettingTest extends NetCommonsGetTest {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.circular_notices.circular_notice_choice',
		'plugin.circular_notices.circular_notice_content',
		'plugin.circular_notices.circular_notice_frame_setting',
		'plugin.circular_notices.circular_notice_setting',
		'plugin.circular_notices.circular_notice_target_user',
	);

/**
 * Plugin name
 *
 * @var string
 */
	public $plugin = 'circular_notices';

/**
 * Model name
 *
 * @var string
 */
	protected $_modelName = 'CircularNoticeFrameSetting';

/**
 * Method name
 *
 * @var string
 */
	protected $_methodName = 'getCircularNoticeFrameSetting';

/**
 * getCircularNoticeFrameSetting()のテスト
 *
 * @return void
 */
	public function testGetCircularNoticeFrameSetting() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$created = null;

		//テスト実施
		$result = $this->$model->$methodName($created);

		//チェック

		//データ生成
		$created = true;

		//テスト実施
		$result = $this->$model->$methodName($created);

		//チェック
	}

}
