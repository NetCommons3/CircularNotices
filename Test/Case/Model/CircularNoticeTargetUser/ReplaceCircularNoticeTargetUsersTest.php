<?php
/**
 * CircularNoticeTargetUser::replaceCircularNoticeTargetUsers()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsModelTestCase', 'NetCommons.TestSuite');

/**
 * CircularNoticeTargetUser::replaceCircularNoticeTargetUsers()のテスト
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\CircularNotices\Test\Case\Model\CircularNoticeTargetUser
 */
class CircularNoticeTargetUserReplaceCircularNoticeTargetUsersTest extends NetCommonsModelTestCase {

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
	protected $_modelName = 'CircularNoticeTargetUser';

/**
 * Method name
 *
 * @var string
 */
	protected $_methodName = 'replaceCircularNoticeTargetUsers';

/**
 * テストデータ
 *
 * @return array
 */
	private function __data() {
		//データ生成
		return array(
			0 => array('CircularNoticeTargetUser' => array(
				'user_id' => '1',
				'circular_notice_content_id' => '1',
			)),
			1 => array('CircularNoticeTargetUser' => array(
				'user_id' => '1',
				'circular_notice_content_id' => '2',
			)),
			2 => array('CircularNoticeTargetUser' => array(
				'user_id' => '1',
				'circular_notice_content_id' => '3',
			)),
			3 => array('CircularNoticeTargetUser' => array(
				'user_id' => '1',
				'circular_notice_content_id' => '4',
			)),
		);
	}

/**
 * replaceCircularNoticeTargetUsers()のテスト
 *
 * @return void
 */
	public function testReplaceCircularNoticeTargetUsers() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$data['CircularNoticeTargetUsers'] = $this->__data();
		// $contentIdの値設定
		$data['CircularNoticeContent']['id'] = 4;

		// 例外を発生させるためのモック
		$choicesMock = $this->getMockForModel('CircularNotices.' . $model, ['deleteAll']);
		$choicesMock->expects($this->any())
			->method('deleteAll')
			->will($this->returnValue(false));

		//テスト実施
		$result = $this->$model->$methodName($data);

		//チェック
		$this->assertTrue($result);
	}

/**
 * validateCircularNoticeTargetUser() falseのテスト
 *
 * @return void
 */
	public function testValidateCircularNoticeTargetUserFalse() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$data['CircularNoticeTargetUsers'] = $this->__data();
		// $contentIdの値設定
		$data['CircularNoticeContent']['id'] = 4;

		// falseを発生させるためのモック
		$choicesMock = $this->getMockForModel('CircularNotices.' . $model, ['validateCircularNoticeTargetUser']);
		$choicesMock->expects($this->any())
			->method('validateCircularNoticeTargetUser')
			->will($this->returnValue(false));
		$result = $choicesMock->$methodName($data);

		//チェック
		$this->assertFalse($result);
	}

/**
 * データ保存 例外テスト
 *
 * @return void
 */
	public function testSaveException() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;
		$this->setExpectedException('InternalErrorException');

		//データ生成
		$data['CircularNoticeTargetUsers'] = $this->__data();
		// $contentIdの値設定
		$data['CircularNoticeContent']['id'] = 4;

		// 例外を発生させるためのモック
		$choicesMock = $this->getMockForModel('CircularNotices.' . $model, ['save']);
		$choicesMock->expects($this->any())
			->method('save')
			->will($this->returnValue(false));

		$result = $choicesMock->$methodName($data);

		//チェック
		$this->assertInstanceOf('InternalErrorException', $result);
	}

/**
 * データ保存 例外テスト
 *
 * @return void
 */
	public function testTargetUser() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$data['CircularNoticeTargetUsers'] = $this->__data();
		// $contentIdの値設定
		$data['CircularNoticeContent']['id'] = 1;

		$result = $this->$model->$methodName($data);

		//チェック
		$this->assertTrue($result);
	}
}
