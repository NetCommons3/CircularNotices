<?php
/**
 * CircularNoticesMailSettingsControllerのテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsControllerTestCase', 'NetCommons.TestSuite');
App::uses('CircularNoticeMailSettingsController', 'CircularNotices.Controller');

/**
 * CircularNoticesMailSettingsControllerのテスト
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\CircularNotices\Test\Case\Controller\CircularNoticesController
 */
class CircularNoticesMailSettingsControllerTest extends NetCommonsControllerTestCase {

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
 * CircularNoticeMailSettingsControllerのテスト
 */
    public function testCircularNoticeMailSettingsController() {
        $stub = $this->getMockBuilder('CircularNoticeMailSettingsController')->getMock();
        $this->assertNotEmpty($stub->helpers);
    }
}