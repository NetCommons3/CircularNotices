<?php
/**
 * CircularNoticesController::__parseRequestForSave()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsControllerTestCase', 'NetCommons.TestSuite');
App::uses('CircularNoticesController', 'CircularNotices.Controller');

/**
 * CircularNoticesController::index()のテスト
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\CircularNotices\Test\Case\Controller\CircularNoticesController
 */
class CircularNoticesControllerParseRequestForSaveTest extends NetCommonsControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
    public $fixtures = array(
    );

/**
 * Plugin name
 *
 * @var string
 */
    public $plugin = 'circular_notices';

/**
 * Controller name
 *
 * @var string
 */
    protected $_controller = 'circular_notices';


/**
 * __parseRequestForSaveメソッドのテスト用DataProvider
 *
 * ### 戻り値
 *  - urlOptions: URLオプション
 *  - assert: テストの期待値
 *  - exception: Exception
 *  - return: testActionの実行後の結果
 *
 * @return array
 */
    public function dataProviderParseRequestForSave() {
        //テストデータ
        $results = array();
        $results[1]= array(
            'data' => array(
                'CircularNoticeContent' => array(
                    'reply_type' => '1',
                    'is_room_targeted_flag' => 1,
                    'target_groups' => array(),
                    'reply_deadline_set_flag' => 1,
                ),
            ),
            'assert' => array('method' => 'assertNotEmpty')
        );
        $results[2]= array(
            'data' => array(
                'CircularNoticeContent' => array(
                    'reply_type' => '2',
                    'is_room_targeted_flag' => 0,
                    'target_groups' => array(1,2,3),
                    'reply_deadline_set_flag' => 1,
                ),
            ),
            'assert' => array('method' => 'assertNotEmpty')
        );
        $results[3]= array(
            'data' => array(
                'CircularNoticeContent' => array(
                    'reply_type' => '2',
                    'is_room_targeted_flag' => 0,
                    'target_groups' => array(1,2,3),
                    'reply_deadline_set_flag' => 0,
                ),
                'CircularNoticeChoices' => array(
                    1 => array(
                        'CircularNoticeChoice' => array('value' => 'ccc'),
                    ),
                    2 => array(
                        'CircularNoticeChoice' => array('value' => 'bbb'),
                    ),
                ),
            ),
            'assert' => array('method' => 'assertNotEmpty')
        );

        return $results;
    }

/**
 * __parseRequestForSaveアクションのテスト(ログインなし)
 *
 * @param $data
 * @param array $assert
 * @param null $exception
 * @dataProvider dataProviderParseRequestForSave
 */
    public function testParseRequestForSave($data, $assert, $exception=null) {
        //テスト実施

        $stub = $this->getMockBuilder('CircularNoticesControllerParseRequestForSaveMock')
            ->setMethods(null)
            ->getMock();
        $stub->data = $data;
        $method = new ReflectionMethod($stub, '__parseRequestForSave');
        $method->setAccessible(true);
        $method->invoke($stub);

        $this->$assert['method']($stub->data);


    }
}

/**
 * CircularNoticesControllerParseRequestForSaveMock
 * CircularNoticesController 継承
 */
class CircularNoticesControllerParseRequestForSaveMock extends CircularNoticesController {
    public $data;
}