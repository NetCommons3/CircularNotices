<?php
/**
 * CircularNoticeChoice::replaceCircularNoticeChoices()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsModelTestCase', 'NetCommons.TestSuite');

/**
 * CircularNoticeChoice::replaceCircularNoticeChoices()のテスト
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\CircularNotices\Test\Case\Model\CircularNoticeChoice
 */
class CircularNoticeChoiceReplaceCircularNoticeChoicesTest extends NetCommonsModelTestCase {

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
	protected $_modelName = 'CircularNoticeChoice';

/**
 * Method name
 *
 * @var string
 */
	protected $_methodName = 'replaceCircularNoticeChoices';

/**
 * SaveのDataProvider
 *
 * ### 戻り値
 *  - content_id CircularNoticeContentのid
 *  - saveData CircularNoticeChoicesのデータ
 *
 * @return array
 */
	public function dataProvider() {
		return array(
			array('content_id' => '1',
				'saveData' => array(
					'CircularNoticeChoice' =>
						array(
							'id' => 1,
							'circular_notice_content_id' => 1,
							'value' => 'frame_1',
							'weight' => 1,
							'created_user' => 1,
							'created' => '2015-03-09 09:25:18',
							'modified_user' => 1,
							'modified' => '2015-03-09 09:25:18'
						)
				)
			),
			array('content_id' => '2',
				'saveData' => array(
					'CircularNoticeChoice' =>
						array(
							'id' => 2,
							'circular_notice_content_id' => 'error',
							'value' => null,
							'weight' => 2,
							'created_user' => 2,
							'created' => '2015-03-09 10:25:18',
							'modified_user' => 2,
							'modified' => '2015-03-09 10:25:18'
						)
				)
			)
		);
	}

/**
 * replaceCircularNoticeChoices()のテスト
 *
 * @param int $contentId CircularNoticeContentのid
 * @param array $saveData CircularNoticeChoicesのデータ
 * @dataProvider dataProvider
 * @return void
 */
	public function testReplaceCircularNoticeChoices($contentId, $saveData) {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		$data['CircularNoticeContent']['id'] = $contentId;
		$data['CircularNoticeChoices'][] = $saveData;

		//テスト実施
		$result = $this->$model->$methodName($data);

		//チェック
		$this->assertTrue(is_bool($result));
	}

/**
 * データ保存 例外テスト
 *
 * @return void
 */
	public function testSaveReplaceCircularNoticeChoicesException() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;
		$this->setExpectedException('InternalErrorException');

		$data = array('CircularNoticeContent' => array('id' => '1'));
		$data['CircularNoticeChoices'][] = array('CircularNoticeChoice' => array(
			'id' => 1,
			'circular_notice_content_id' => 1,
			'value' => 'frame_1',
			'weight' => 1,
			'created_user' => 1,
			'created' => '2015-03-09 09:25:18',
			'modified_user' => 1,
			'modified' => '2015-03-09 09:25:18'
		),
		);

		// 例外を発生させるためのモック
		$choicesMock = $this->getMockForModel('CircularNotices.' . $model, ['save']);
		$choicesMock->expects($this->any())
			->method('save')
			->will($this->returnValue(false));

		$choicesMock->$methodName($data);
	}
}
