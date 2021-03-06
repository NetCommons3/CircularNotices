<?php
/**
 * CircularNoticeTargetUserBehavior::validates()テスト用Model
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('AppModel', 'Model');

/**
 * CircularNoticeTargetUserBehavior::validates()テスト用Model
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\CircularNotices\Test\test_app\Plugin\TestCircularNotices\Model
 */
class TestCircularNoticeTargetUserBehaviorValidate extends AppModel {

/**
 * 使用ビヘイビア
 *
 * @var array
 */
	public $actsAs = array(
		'CircularNotices.CircularNoticeTargetUser'
	);

}
