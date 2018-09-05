<?php

namespace app\modules\edulab;

use Yii;
use yii\helpers\Html;
use common\modules\profile\models\ProfileExtended;
use common\modules\organization\models\OrganizationAdminuser;

use common\modules\core\models\Message;
use common\models\Notification;

use bizley\podium\models\User as PodiumUser;
use bizley\podium\Podium as Podium;
use yii\base\InvalidConfigException;

/**
 * edulab module definition class
 */
class Edulab extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\edulab\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

$podiumuser = PodiumUser::findMe();
                    if (empty($podiumuser)) {
                     /*   if (!PodiumUser::createInheritedAccount()) {
                            throw new InvalidConfigException('There was an error while creating inherited user account. Podium can not run with the current configuration. Please contact administrator about this problem.');
                        } else {
                            echo 'create podium';
                        }
                        */
                    } elseif (!PodiumUser::updateInheritedAccount()) {
                        throw new InvalidConfigException('There was an error while updating inherited user account. Podium can not run with the current configuration. Please contact administrator about this problem.');
                    }

        // custom initialization code goes here
        // custom check buat keperluan edulab:
//      1. sudah pilih education level atau belum

          if (Yii::$app->user->isGuest) {
     /*   $ed_level = ProfileExtended::find()->andWhere(['type' => 'edulab'])->andWhere(['key' => 'ed_level'])->andWhere(['user_id' => Yii::$app->user->id])->One();
        if(!isset($ed_level->value))
            Yii::$app->session->addFlash('warning', 'Anda belum menentukan jurusan anda. ' . Html::a(Yii::t('app','Klik disini'), ['/edulab/profile/profile#edulab']));

        $edulab_id = ProfileExtended::find()->andWhere(['type' => 'edulab'])->andWhere(['key' => 'id'])->andWhere(['user_id' => Yii::$app->user->id])->One();
        if(!isset($edulab_id->value))
            Yii::$app->session->addFlash('warning', 'Anda belum mendaftarkan edulab ID anda.'. Html::a(Yii::t('app','Klik disini'), ['/edulab/profile/profile#edulab']));

        $location_id = ProfileExtended::find()->andWhere(['type' => 'edulab'])->andWhere(['key' => 'location'])->andWhere(['user_id' => Yii::$app->user->id])->One();
        if(!isset($edulab_id->value))
            Yii::$app->session->addFlash('warning', 'Anda belum mendaftarkan lokasi edulab anda.'. Html::a(Yii::t('app','Klik disini'), ['/edulab/profile/profile#edulab']));
*/
    } else {
              //only if not parent & not admin
        $parent = ProfileExtended::find()
        ->andWhere(['user_id' => Yii::$app->user->id])
        ->andWhere(['type' => 'edulab'])
        ->andWhere(['key' => 'isparent'])
        ->andWhere(['value' => 'true'])
        ->One();

        $admin = OrganizationAdminuser::find()
        ->andWhere(['user_id' => Yii::$app->user->id])
        ->andWhere(['status' => 'active'])
        ->One();


          if(!isset($parent) && !isset($admin)) {
              $messages = Message::find()->andWhere(['type' => 'notification'])->andWhere(['status' => 'active'])->All();
              foreach ($messages as $message) {
                $mesg = Notification::find()->andWhere(['user_id' => Yii::$app->user->id])->andWhere(['key_id' => $message->id])->One();
                if (null == $mesg) {
              //    Notification::notify(Notification::KEY_NEW_MESSAGE, Yii::$app->user->id, $message->id);
                 // echo '1';
                } else {

                }
              }
           //   echo '<br/><br/><br/><br/><br/><br/><pre><br/><br/><br/><br/><br/><br/>';
             // print_r($messages);
/*
         $ed_level = ProfileExtended::find()->andWhere(['type' => 'edulab'])->andWhere(['key' => 'ed_level'])->andWhere(['user_id' => Yii::$app->user->id])->One();
                if(!isset($ed_level->value)) {
                    Yii::$app->session->addFlash('warning', 'Anda belum menentukan jurusan anda. -->' . Html::a(Yii::t('app','KLIK DISINI'), ['/edulab/profile/profile#edulab']));
                  }
                $edulab_id = ProfileExtended::find()->andWhere(['type' => 'edulab'])->andWhere(['key' => 'id'])->andWhere(['user_id' => Yii::$app->user->id])->One();
                if(!isset($edulab_id->value))
                {
                    Yii::$app->session->addFlash('warning', 'Anda belum mendaftarkan edulab ID anda. -->'. Html::a(Yii::t('app','KLIK DISINI'), ['/edulab/profile/profile#edulab']));
                  }
                $location_id = ProfileExtended::find()->andWhere(['type' => 'edulab'])->andWhere(['key' => 'location'])->andWhere(['user_id' => Yii::$app->user->id])->One();
                if(!isset($edulab_id->value)) {
                    Yii::$app->session->addFlash('warning', 'Anda belum mendaftarkan lokasi edulab anda. -->'. Html::a(Yii::t('app','KLIK DISINI'), ['/edulab/profile/profile#edulab']));
                  }
*/
            }

            
          }
    }
}
