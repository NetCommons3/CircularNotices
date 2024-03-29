<?php
/**
 * CircularNoticesController::edit()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsControllerTestCase', 'NetCommons.TestSuite');

/**
 * CircularNoticesController::edit()のテスト
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\CircularNotices\Test\Case\Controller\CircularNoticesController
 */
class CircularNoticesControllerEditTest extends NetCommonsControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.site_manager.site_setting',
		'plugin.users.user',
		'plugin.mails.mail_setting',
		'plugin.mails.mail_queue',
		'plugin.mails.mail_queue_user',
		'plugin.circular_notices.circular_notice_choice',
		'plugin.circular_notices.circular_notice_content',
		'plugin.circular_notices.circular_notice_frame_setting',
		'plugin.circular_notices.circular_notice_setting',
		'plugin.circular_notices.circular_notice_target_user',
		'plugin.user_attributes.user_attribute_layout',
		'plugin.frames.frame',
		'plugin.blocks.block',
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
 * テストDataの取得
 *
 * @param string $role ロール
 * @return array
 */
	private function __getData($role = null) {
		$frameId = '6';
		$blockId = '2';
		$contentKey = 'circular_notice_content_1';

		$data = array(
			'frame_id' => $frameId,
			'block_id' => $blockId,
			'key' => $contentKey,
		);

		return $data;
	}

/**
 * editアクションテスト
 *
 * ### 戻り値
 *  - urlOptions: URLオプション
 *  - assert: テストの期待値
 *  - exception: Exception
 *  - return: testActionの実行後の結果
 *
 * @return array
 */
	public function dataProviderEdit() {
		$data = $this->__getData();

		//テストデータ
		$results = array();
		$results[0] = array(
			'urlOptions' => Hash::insert($data, 'frame_id', ''),
			'assert' => null,
			'exception' => 'BadRequestException'
		);
		$results[1] = array(
			'urlOptions' => Hash::insert($data, 'key', 'A'),
			'assert' => null,
			'exception' => 'BadRequestException'
		);
		$results[2] = array(
			'urlOptions' => $data,
			'assert' => array('method' => 'assertNotEmpty'),
		);
		$results[3] = array(
			'urlOptions' => Hash::insert($data, 'key', 'circular_notice_content_4'),
			'assert' => null,
			'exception' => 'BadRequestException'
		);

		return $results;
	}

/**
 * editアクションのテスト
 *
 * @param array $urlOptions URLオプション
 * @param array $assert テストの期待値
 * @param string|null $exception Exception
 * @param string $return testActionの実行後の結果
 * @dataProvider dataProviderEdit
 * @return void
 */
	public function testEdit($urlOptions, $assert, $exception = null, $return = 'view') {
		//ログイン
		TestAuthGeneral::login($this, Role::ROOM_ROLE_KEY_ROOM_ADMINISTRATOR);

		//テスト実施
		$url = Hash::merge(array(
			'plugin' => $this->plugin,
			'controller' => $this->_controller,
			'action' => 'edit',
		), $urlOptions);
		$this->_testGetAction($url, $assert, $exception, $return);

		//ログアウト
		TestAuthGeneral::logout($this);
	}

/**
 * editアクションテスト
 *
 * ### 戻り値
 *  - urlOptions: URLオプション
 *  - assert: テストの期待値
 *  - exception: Exception
 *  - return: testActionの実行後の結果
 *
 * @return array
 */
	public function dataProviderEditPost() {
		$data = $this->__getData();
		//テストデータ
		return array(
			array(
				'urlOptions' => $data,
				'data' => array(
					'save_1' => '',
					'Frame' => array('id' => $data['frame_id']),
					'Block' => array('id' => $data['block_id']),
					'CircularNoticeContent' => array(
						'id' => '',
						'reply_type' => '1',
						'is_room_target' => '',
						'publish_start' => '',
						'publish_end' => '',
						'use_reply_deadline' => 0,
						'reply_deadline' => ''
					),
					'CircularNoticeTargetUser' => array(
						0 => array('user_id' => 1),
					),
				),
				'assert' => array('method' => 'assertNotEmpty'),
			),
			array(
				'urlOptions' => $data,
				'data' => array(
					'save_1' => '',
					'Frame' => array('id' => $data['frame_id']),
					'Block' => array('id' => $data['block_id']),
					'CircularNoticeContent' => array(
						'id' => 1,
						'circular_notice_setting_key' => 'circular_notice_setting_1',
						'subject' => 'Lorem ipsum dolor sit amet',
						'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
						'reply_type' => '2',
						'is_room_target' => 1,
						'publish_start' => '2016-01-01 00:00',
						'publish_end' => '2016-12-01 00:00',
						'use_reply_deadline' => '1',
						'reply_deadline' => '2016-06-28 00:00'
					),
					'CircularNoticeChoices' => array(
						0 => array(
							'CircularNoticeChoice' => array(
								'id' => '',
								'weight' => '1',
								'value' => 'aaa',
							),
						),
					),
					'CircularNoticeTargetUser' => array(
						0 => array('user_id' => 1),
					),
				),
				'assert' => array('method' => 'assertNotEmpty'),
			),
			array(
				'urlOptions' => $data,
				'data' => array(
					'save_1' => '',
					'Frame' => array('id' => $data['frame_id']),
					'Block' => array('id' => $data['block_id']),
					'CircularNoticeContent' => array(
						'id' => 1,
						'circular_notice_setting_key' => 'circular_notice_setting_1',
						'subject' => 'Lorem ipsum dolor sit amet',
						'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
						'reply_type' => '3',
						'is_room_target' => 1,
						'publish_start' => '2016-01-01 00:00',
						'publish_end' => '2016-12-01 00:00',
						'use_reply_deadline' => '0',
					),
				),
				'assert' => array('method' => 'assertNotEmpty'),
			),
			array(
				'urlOptions' => Hash::insert($data, 'key', 'circular_notice_content_2'),
				'data' => array(
					'role' => Role::ROOM_ROLE_KEY_GENERAL_USER,
					'save_1' => '',
					'CircularNoticeContent' => array(
						'id' => 2,
						'key' => 'circular_notice_content_2',
					),
				),
				'assert' => null,
				'exception' => 'BadRequestException'
			),
		);
	}

/**
 * editアクションのPOSTテスト
 *
 * @param array $urlOptions URLオプション
 * @param array $data POSTデータ
 * @param array $assert テストの期待値
 * @param string|null $exception Exception
 * @param string $return testActionの実行後の結果
 * @dataProvider dataProviderEditPost
 * @return void
 */
	public function testEditPost($urlOptions, $data, $assert, $exception = null, $return = 'view') {
		//ログイン
		TestAuthGeneral::login($this, Role::ROOM_ROLE_KEY_GENERAL_USER);
		//テスト実施
		$this->_testPostAction('post', $data, Hash::merge(array('action' => 'edit'), $urlOptions), $exception, $return);
		//ログアウト
		TestAuthGeneral::logout($this);
	}

/**
 * editアクションFalseテスト
 *
 * ### 戻り値
 *  - urlOptions: URLオプション
 *  - assert: テストの期待値
 *  - exception: Exception
 *  - return: testActionの実行後の結果
 *
 * @return array
 */
	public function dataProviderEditPostFalse() {
		$data = $this->__getData();
		//テストデータ
		return array(
			array(
				'urlOptions' => $data,
				'data' => array(
					'save_1' => '',
					'Frame' => array('id' => $data['frame_id']),
					'Block' => array('id' => $data['block_id']),
					'CircularNoticeContent' => array(
							'id' => '',
							'reply_type' => '1',
							'is_room_target' => '',
							'publish_start' => '',
							'publish_end' => '',
							'use_reply_deadline' => 0,
							'reply_deadline' => ''
					),
					'CircularNoticeTargetUser' => array(
							0 => array('user_id' => 1),
					),
				),
				'assert' => array('method' => 'assertNotEmpty'),
			),
			array(
				'urlOptions' => $data,
				'data' => array(
					'save_1' => '',
					'Frame' => array('id' => $data['frame_id']),
					'Block' => array('id' => $data['block_id']),
					'CircularNoticeContent' => array(
						'id' => 1,
						'circular_notice_setting_key' => 'circular_notice_setting_1',
						'subject' => 'Lorem ipsum dolor sit amet',
						'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
						'reply_type' => '2',
						'is_room_target' => 1,
						'publish_start' => '2016-01-02 00:00',
						'publish_end' => '2016-01-01 00:00',
						'use_reply_deadline' => '1',
						'reply_deadline' => '2016-06-28 00:00'
					),
					'CircularNoticeChoices' => array(
						0 => array(
								'CircularNoticeChoice' => array(
										'id' => '',
										'weight' => '1',
										'value' => 'aaa',
								),
						),
						1 => array(
								'CircularNoticeChoice' => array(
										'id' => '',
										'weight' => '2',
										'value' => 'bbb',
								),
						),
					),
					'CircularNoticeTargetUser' => array(
							0 => array('user_id' => 1),
					),
				),
				'assert' => array('method' => 'assertNotEmpty'),
			),
			array(
				'urlOptions' => $data,
				'data' => array(
					'save_1' => '',
					'Frame' => array('id' => $data['frame_id']),
					'Block' => array('id' => $data['block_id']),
					'CircularNoticeContent' => array(
						'id' => 1,
						'circular_notice_setting_key' => 'circular_notice_setting_1',
						'subject' => 'Lorem ipsum dolor sit amet',
						'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
						'reply_type' => '3',
						'is_room_target' => 1,
						'publish_start' => '2016-01-01 00:00',
						'publish_end' => '2016-12-01 00:00',
						'use_reply_deadline' => '0',
					),
					'CircularNoticeChoices' => array(
						0 => array(
							'CircularNoticeChoice' => array(
								'id' => '',
								'weight' => '1',
								'value' => 'aaa',
							),
						),
					),
					'CircularNoticeTargetUser' => array(
						0 => array('user_id' => 1),
					),
				),
				'assert' => array('method' => 'assertNotEmpty'),
			),
		);
	}

/**
 * editアクションのPOSTテスト
 *
 * @param array $urlOptions URLオプション
 * @param array $data POSTデータ
 * @param array $assert テストの期待値
 * @param string|null $exception Exception
 * @param string $return testActionの実行後の結果
 * @dataProvider dataProviderEditPostFalse
 * @return void
 */
	public function testEditPostFalse($urlOptions, $data, $assert, $exception = null, $return = 'view') {
		//ログイン
		TestAuthGeneral::login($this, Role::ROOM_ROLE_KEY_GENERAL_USER);
		//テスト実施
		$this->_testPostAction('post', $data, Hash::merge(array('action' => 'edit'), $urlOptions), $exception, $return);
		//ログアウト
		TestAuthGeneral::logout($this);
	}
}
