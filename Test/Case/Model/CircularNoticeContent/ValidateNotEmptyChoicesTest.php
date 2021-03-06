<?php
/**
 * CircularNoticeContent::validateNotEmptyChoices()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsModelTestCase', 'NetCommons.TestSuite');

/**
 * CircularNoticeContent::validateNotEmptyChoices()のテスト
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\CircularNotices\Test\Case\Model\CircularNoticeContent
 */
class CircularNoticeContentValidateNotEmptyChoicesTest extends NetCommonsModelTestCase {

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
	protected $_modelName = 'CircularNoticeContent';

/**
 * Method name
 *
 * @var string
 */
	protected $_methodName = 'validateNotEmptyChoices';

/**
 * validateNotEmptyChoices()のテスト
 *
 * @return void
 */
	public function testValidateNotEmptyChoices() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;
		// 仮入用の引数作成
		$check = 'fields';

		//データ生成
		$this->$model->data['CircularNoticeContent']['reply_type'] = 1;

		//テスト実施
		$result = $this->$model->$methodName($check);
		//チェック
		$this->assertTrue($result);

		//データ生成
		$this->$model->data['CircularNoticeContent']['reply_type'] = 2;
		$this->$model->data['CircularNoticeChoices'] = true;

		//テスト実施
		$result = $this->$model->$methodName($check);
		//チェック
		$this->assertTrue($result);
	}

/**
 * validateNotEmptyChoices()のFalseテスト
 *
 * @return void
 */
	public function testValidateNotEmptyChoicesFalse() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;
		// 仮入用の引数作成
		$check = 'fields';

		//データ生成
		$this->$model->data['CircularNoticeContent']['reply_type'] = 2;

		//テスト実施
		$result = $this->$model->$methodName($check);
		//チェック
		$this->assertFalse($result);

		//データ生成
		$this->$model->data['CircularNoticeContent']['reply_type'] = 3;
		$this->$model->data['CircularNoticeChoices'] = null;

		//テスト実施
		$result = $this->$model->$methodName($check);
		//チェック
		$this->assertFalse($result);
	}

}
