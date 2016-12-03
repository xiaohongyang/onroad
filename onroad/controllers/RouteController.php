<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\MatchModel;
use app\models\TeamModel;
use app\models\TeamUpdateForm;
use app\models\UserModel;

class RouteController extends BaseController
{

    public function actionMatch()
    {

        $this->checkLogin(true);

        $matchModel = new MatchModel();
        $userId = \Yii::$app->user->identity->getId();
        $rs = $matchModel->match(UserModel::findOne(['id'=> $userId]));

        if($rs) {
            $this->renderJson(1, "匹配成功");
        } else {
            $this->renderJson(0, $matchModel->message ? : "当前暂无与您匹配的路线");
        }

    }
    public function actionGetMobileCheckcode(){

        $mobile = \Yii::$app->request->post('mobile');
        $model = new LoginForm();
        $result = $model->getMobileCheckcode($mobile);
        if($result !== true)
            $this->renderJson(0, $result);
        else{
            $this->renderJson(1,"短信验证码已发送!");
        }
    }

    public function actionEdit() {


        $this->checkLogin(true);

        if (\Yii::$app->request->isPost) {

            $post = \Yii::$app->request->post();
            $teamId = $post['teamId'];
            $teamUpdateForm = TeamUpdateForm::findOne(['team_id' => $teamId]);
            if(\Yii::$app->user->identity->getId() != $teamUpdateForm->getAttribute('driver_user_id')) {
                $this->renderJson(0, '您不是改组司机,没有修改权限');
            } else {
                $rs = $teamUpdateForm->edit($post);
                if($rs) {
                    $this->renderJson(1, '更新成功');
                } else {
                    $this->renderJson(0, '更新失败');
                }
            }
        } else {
            $this->renderJson(-1, '非法访问');
        }
    }

}
