<?php
/**
 * CircularNoticeTargetUser Behavior
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2016, NetCommons Project
 */

App::uses('ModelBehavior', 'Model');

/**
 * CircularNoticeTargetUser Behavior
 *
 * 選択したユーザを登録
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
class CircularNoticeTargetUserBehavior extends ModelBehavior {

/**
 * beforeValidate is called before a model is validated, you can use this callback to
 * add behavior validation rules into a models validate array. Returning false
 * will allow you to make the validation fail.
 *
 * @param Model $model Model using this behavior
 * @param array $options Options passed from Model::save().
 * @return mixed False or null will abort the operation. Any other result will continue.
 * @see Model::save()
 */
	public function beforeValidate(Model $model, $options = array()) {
		$model->loadModels(array(
			'CircularNoticeContent' => 'CircularNotices.CircularNoticeContent',
			'CircularNoticeTargetUser' => 'CircularNotices.CircularNoticeTargetUser',
			'User' => 'Users.User',
		));

		if (empty($model->data['CircularNoticeContent']['is_room_target'])) {
			// 回覧先ユーザのバリデーション処理
			if (! isset($model->data['CircularNoticeTargetUser'])) {
				$model->data['CircularNoticeTargetUser'] = array();
			}
			$model->CircularNoticeTargetUser->set($model->data['CircularNoticeTargetUser']);

			// ユーザ選択チェック
			$targetUsers = [];
			foreach ($model->data['CircularNoticeTargetUser'] as $datum) {
				$targetUsers[] = $datum['user_id'];
			}
			if (! $model->CircularNoticeTargetUser->isUserSelected($targetUsers)) {
				$model->CircularNoticeTargetUser->validationErrors['user_id'] =
					sprintf(__d('circular_notices', 'Select user'));
				$model->validationErrors =
					array_merge($model->validationErrors, $model->CircularNoticeTargetUser->validationErrors);
				return false;
			}

			if (! $model->CircularNoticeTargetUser->validates()) {
				$model->validationErrors =
					array_merge($model->validationErrors, $model->CircularNoticeTargetUser->validationErrors);
				return false;
			}

			if (! $model->User->existsUser($targetUsers)) {
				$model->CircularNoticeTargetUser->validationErrors['user_id'][] =
					sprintf(__d('net_commons', 'Failed on validation errors. Please check the input data.'));
				$model->validationErrors =
					array_merge($model->validationErrors, $model->CircularNoticeTargetUser->validationErrors);
				return false;
			}
		}

		return true;
	}

}
