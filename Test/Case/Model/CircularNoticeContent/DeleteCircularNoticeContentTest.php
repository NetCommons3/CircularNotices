<?php
/**
 * CircularNoticeContent::deleteCircularNoticeContent()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsModelTestCase', 'NetCommons.TestSuite');
App::uses('CircularNoticesAppModel', 'CircularNotices.Model');
App::uses('CircularNoticeTargetUserFixture', 'CircularNotices.Test/Fixture');
App::uses('CircularNoticeContentFixture', 'CircularNotices.Test/Fixture');
App::uses('CircularNoticeTargetUserFixture', 'CircularNotices.Test/Fixture');


/**
 * CircularNoticeContent::deleteCircularNoticeContent()のテスト
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\CircularNotices\Test\Case\Model\CircularNoticeContent
 */
class CircularNoticeContentDeleteCircularNoticeContentTest extends NetCommonsModelTestCase {

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
	protected $_methodName = 'deleteCircularNoticeContent';

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CircularNoticeContent);
		unset($this->TargetUser);

		parent::tearDown();
	}

/**
 * ExceptionError
 *
 * @return void
 */
	public function testCircularNoticeTargetUserDelete() {
		$key = 'frame_4';
		$model = $this->_modelName;
		$methodName = $this->_methodName;
		$this->$model->$methodName($key);
	}

/**
 * ExceptionError
 *
 * @return void
 */
	public function testCircularNoticeTargetUserDeleteExceptionError() {
		$key = 'frame_4';
		$model = $this->_modelName;
		$methodName = $this->_methodName;
		$this->setExpectedException('InternalErrorException');

		$this->_mockForReturnFalse($model, 'CircularNoticeTargetUser', 'deleteAll');
		$this->$model->$methodName($key);
	}

/**
 * ExceptionError
 *
 * @return void
 */
	public function testCircularNoticeChoiceDeleteExceptionError() {
		$key = 'frame_4';
		$model = $this->_modelName;
		$methodName = $this->_methodName;
		$this->setExpectedException('InternalErrorException');

		$this->_mockForReturnFalse($model, 'CircularNoticeChoice', 'deleteAll');
		$this->$model->$methodName($key);
	}

/**
 * ExceptionError
 *
 * @return void
 */
	public function testCircularNoticeContentDeleteExceptionError() {
		$key = 'frame_5';
		$model = $this->_modelName;
		$methodName = $this->_methodName;
		$this->setExpectedException('InternalErrorException');

		$choicesMock = $this->getMockForModel('CircularNotices.' . $model, ['delete']);
		$choicesMock->expects($this->any())
				->method('delete')
				->will($this->returnValue(false));
		$choicesMock->$methodName($key);
	}
}
