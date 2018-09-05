<?php

namespace app\modules\edulab\controllers;
use yii;

use common\modules\profile\models\ProfileExtended;
use common\modules\profile\models\ProfileGeneral;
use common\modules\catalog\models\RewardGeneral;

use common\modules\ref\models\Log;
use common\models\ImageUpload;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\helpers\Url;
use yii\web\UploadedFile;

use common\models\Notification;
use common\modules\core\models\Message;
use common\models\EmailVerification;
use common\models\LoginForm;

use yii\imagine\Image;
//use common\models\SignupForm;
//use app\modules\cats\models\JobCatalogSearch;
//use app\modules\cats\models\JobCandidate;




class ProfileController extends \common\modules\profile\controllers\ProfileController
{


    public function actionGivereward($id)
    {

        $existing_reward = 0;

            $user_reward = ProfileExtended::find()
            ->andWhere(['user_id' => Yii::$app->user->id])
            ->andWhere(['type' => 'edulab'])
            ->andWhere(['key' => 'reward'])
            ->One();

            $reward = RewardGeneral::find()
            ->andWhere(['id' => $id])
            ->andWhere(['status' => 'active'])
            ->One();

            if (null !== $reward) {
$rewardpoint = $reward->reward_point;
            } else {
                $rewardpoint = 0;
            }

            if (null !== $user_reward) {
$existing_reward = $user_reward->value;
            } else {
                $user_reward = new ProfileExtended;
                $user_reward->user_id = Yii::$app->user->id;
                $user_reward->type = 'edulab';
                $user_reward->key = 'reward';
                $existing_reward = 0;
            }



            $user_reward->value = (string) ($existing_reward + $rewardpoint);
            $user_reward->save();

            print_r($user_reward->errors);


    }

    public function actionResize()
    {
        $imagine = new Image;

            //$image = $imagine->open('/path/to/image.jpg');

        echo 'yte';

    }
    public function actionConfirmparent($user_id, $key)
    {

        $childconfirm = ProfileExtended::find()->andWhere(['user_id' => $user_id])
        ->andWhere(['type' => 'childof'])
        ->andWhere(['key' => $key])
        //->andWhere(['value' => ])
        ->One();
        $childconfirm->value = 'true';
        if ($childconfirm->save()) {
            $childprofile = ProfileGeneral::find()->andWhere(['user_id' => $user_id])->One();
            $parentprofile = ProfileGeneral::find()->andWhere(['user_id' => $key])->One();
                               $newmessage = new Message;
                   $newmessage->type = 'notificattion';
                   $newmessage->message = 'confirmed: ' . $parentprofile->first_name . ' ' . $parentprofile->last_name  . ' is parent to ' . $childprofile->first_name . ' ' . $childprofile->last_name ;
                   $newmessage->status = 'active';
                   if ($newmessage->save()) {
                                       Yii::$app->session->addFlash('success', 'parent is confirmed');
                   Notification::notify(Notification::KEY_NEW_MESSAGE, $user_id, $newmessage->id);
               return $this->redirect(['parent']);
           } else {
            print_r($newmessage->errors);
           }
       } else {

                     throw new NotFoundHttpException('fail confirming parent');
            }
    }

    public function actionUnconfirmparent($user_id, $key)
    {
        $childconfirm = ProfileExtended::find()->andWhere(['user_id' => $user_id])
        ->andWhere(['type' => 'childof'])
        ->andWhere(['key' => $key])
        //->andWhere(['value' => ])
        ->One();
        $childconfirm->value = 'false';


        if ($childconfirm->save()) {
                        $childprofile = ProfileGeneral::find()->andWhere(['user_id' => $user_id])->One();
            $parentprofile = ProfileGeneral::find()->andWhere(['user_id' => $key])->One();
                               $newmessage = new Message;
                   $newmessage->type = 'notificattion';
     $newmessage->message = 'UNconfirmed: ' . $parentprofile->first_name . ' ' . $parentprofile->last_name  . ' is NOT parent to ' . $childprofile->first_name . ' ' . $childprofile->last_name ;
                   $newmessage->status = 'active';
                   if ($newmessage->save()) {
                                       Yii::$app->session->addFlash('success', 'parent is unconfirmed');
                   Notification::notify(Notification::KEY_NEW_MESSAGE, $user_id, $newmessage->id);
               return $this->redirect(['parent']);
           } else {
            print_r($newmessage->errors);
           }
       } else {

                     throw new NotFoundHttpException('fail confirming parent');
            }

    }
public function actionParent()
{

    $query = ProfileExtended::find()->andWhere(['user_id' => Yii::$app->user->id])->andWhere(['type' => 'childof'])
    //->andWhere(['key' => 'childof'])
    ;

        $DataProvider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 20,
    ],
]);



            return $this->render('parent.php', [
                'DataProvider' => $DataProvider,


            ]);


}

public function actionProfile()
{
	if(null !== Profilegeneral::findOne(Yii::$app->user->id)) {
		$model = Profilegeneral::findOne(Yii::$app->user->id);
    } else {
        $model = new ProfileGeneral();
        $model->user_id = Yii::$app->user->id;
    }


$edlevelmodel = ProfileExtended::find()->andWhere(['user_id' => Yii::$app->user->id])->andWhere(['type'=>'edulab'])->andWhere(['key' => 'ed_level'])->One();
if (null !== $edlevelmodel) {
} else {
            $edlevelmodel = new ProfileExtended();
            $edlevelmodel->user_id = $model->user_id;
            $edlevelmodel->type = 'edulab';
            $edlevelmodel->key = 'ed_level';
}

$location = ProfileExtended::find()->andWhere(['user_id' => Yii::$app->user->id])->andWhere(['type'=>'edulab'])->andWhere(['key' => 'location'])->One();
if (null !== $location) {
} else {
            $location = new ProfileExtended();
            $location->user_id = $model->user_id;
            $location->type = 'edulab';
            $location->key = 'location';
}

$edulab_id = ProfileExtended::find()->andWhere(['user_id' => Yii::$app->user->id])->andWhere(['type'=>'edulab'])->andWhere(['key' => 'id'])->One();
if (null !== $edulab_id) {
} else {
            $edulab_id = new ProfileExtended();
            $edulab_id->user_id = $model->user_id;
            $edulab_id->type = 'edulab';
            $edulab_id->key = 'id';
}

$profile_location = ProfileExtended::find()->andWhere(['user_id' => Yii::$app->user->id])->andWhere(['type'=>'profile'])->andWhere(['key' => 'location'])->One();
if (null !== $profile_location) {
} else {
            $profile_location = new ProfileExtended();
            $profile_location->user_id = $model->user_id;
            $profile_location->type = 'profile';
            $profile_location->key = 'location';
}

$timezone = ProfileExtended::find()->andWhere(['user_id' => Yii::$app->user->id])->andWhere(['type'=>'profile'])->andWhere(['key' => 'timezone'])->One();
if (null !== $timezone) {
} else {
            $timezone = new ProfileExtended();
            $timezone->user_id = $model->user_id;
            $timezone->type = 'profile';
            $timezone->key = 'timezone';
}




$avatarmodel = ProfileExtended::find()->andWhere(['user_id' => Yii::$app->user->id])->andWhere(['type'=>'profile-extended'])->andWhere(['key' => 'avatar'])->One();
if (null !== $avatarmodel) {
} else {
            $avatarmodel = new ProfileExtended();
}



$imageuploadmodel = new ImageUpload;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
  
            $imageuploadmodel->imageFile = UploadedFile::getInstance($imageuploadmodel, 'imageFile');


//Image::getImagine()->open($fileName)->thumbnail(new Box($newWidth, $newHeight))->save($savePath , ['quality' => 90]);

/*Image::frame('path/to/image.jpg', 5, '666', 0)
    ->rotate(-8)
    ->save('path/to/destination/image.jpg', ['jpeg_quality' => 50]);
*/

		if(sizeof($imageuploadmodel->imageFile) > 0) {
		     $imageuploadmodel->avatarupload();
		  $avatarmodel->user_id = $model->user_id;
		            $avatarmodel->type = 'profile-extended';
		                    $avatarmodel->key = 'avatar';

		            $avatarmodel->value = $model->user_id .'.' . $imageuploadmodel->imageFile->extension ;
		            $avatarmodel->save();
		        //echo '<br/><br/><br/><br/><br/><pre>';
		          //              print_r($imageuploadmodel);
		}

            
        
            Yii::$app->session->setFlash('success', 'Your profile is updated');
        } 

        


        $mobilemodel = ProfileExtended::find()->andWhere(['user_id' => Yii::$app->user->id])
            ->andWhere(['type' => 'profile-contacts'])
            ->andWhere(['key' => 'mobile'])->One();
            if (isset($mobilemodel)) {
                $mobile = $mobilemodel;
            } else {
                $mobile = new ProfileExtended;
                $mobile->user_id = Yii::$app->user->id;
                $mobile->key = 'mobile';
                $mobile->type = 'profile-contacts';
                   $mobile->value = '';

            }

         $workmodel = ProfileExtended::find()->andWhere(['user_id' => Yii::$app->user->id])
            ->andWhere(['type' => 'profile-contacts'])
            ->andWhere(['key' => 'work'])->One();
            if (isset($workmodel)) {
                $work = $workmodel;
            } else {
                $work = new ProfileExtended;
                $work->user_id = Yii::$app->user->id;
                $work->key = 'work';
                $work->type = 'profile-contacts';
                   $work->value = '';
            }

         $homemodel = ProfileExtended::find()->andWhere(['user_id' => Yii::$app->user->id])
            ->andWhere(['type' => 'profile-contacts'])
            ->andWhere(['key' => 'home'])->One();
            if (isset($homemodel)) {
                $home = $homemodel;
            } else {
                $home = new ProfileExtended;
                $home->user_id = Yii::$app->user->id;
                $home->key = 'home';
                $home->type = 'profile-contacts';
                $home->value = '';
            }

         $homeadressmodel = ProfileExtended::find()->andWhere(['user_id' => Yii::$app->user->id])
            ->andWhere(['type' => 'profile-contacts'])
            ->andWhere(['key' => 'home_address'])->One();
            if (isset($homeadressmodel)) {
                $home_address = $homeadressmodel;
            } else {
                $home_address = new ProfileExtended;
                $home_address->user_id = Yii::$app->user->id;
                $home_address->key = 'home_address';
                $home_address->type = 'profile-contacts';
                   $home_address->value = '';
            }
         $workadressmodel = ProfileExtended::find()->andWhere(['user_id' => Yii::$app->user->id])
            ->andWhere(['type' => 'profile-contacts'])
            ->andWhere(['key' => 'work_address'])->One();
            if (isset($workadressmodel)) {
                $work_address = $workadressmodel;
            } else {
                $work_address = new ProfileExtended;
                $work_address->user_id = Yii::$app->user->id;
                $work_address->key = 'work_address';
                $work_address->type = 'profile-contacts';
                   $work_address->value = '';
            }
    
            $email = Yii::$app->user->identity->email;
            if( null !== $email) {
$emailverification[] = new EmailVerification;
            } else {
$emailverification = EmailVerification::find()
                        ->andWhere(['user_id' => Yii::$app->user->id])
                        ->andWhere(['status' => 'unverified'])->All();

                        if(sizeof($emailverification) == 1) {
                            $email = $emailverification[0]->email;
                        } elseif(sizeof($emailverification) == 0) {
                            $emailverification[0] = new EmailVerification;
                            $email = 'N/A';
                        }
                        else {
                            $email =$emailverification[sizeof($emailverification) - 1]->email;
                        }
}

    if(isset($_POST['work'])) {


                $work->value = $_POST['work'];
                $mobile->value = $_POST['mobile'];
                $home->value = $_POST['home'];
                $home_address->value = $_POST['home_address'];
                $work_address->value = $_POST['work_address'];
                
                Yii::$app->user->identity->email = $_POST['email'];

                $work->save();
                $mobile->save();
                $home->save();
                $home_address->save();
                $work_address->save();
                
                //$email->save();
         Yii::$app->session->addFlash('success','contact saved');
                //return $this->redirect('index');
    }


        if(isset($_POST['edulab_id'])) {

$candidate_edulab_id = ProfileExtended::find()->andWhere(['user_id' => Yii::$app->user->id])->andWhere(['type'=>'edulab'])->andWhere(['key' => 'id'])->One();
if (null !== $candidate_edulab_id) {

} else {
            $candidate_edulab_id = new ProfileExtended();
            $candidate_edulab_id->user_id = $model->user_id;
            $candidate_edulab_id->type = 'edulab';
            //$candidate_edulab_id->key = 'candidate_id';
            $candidate_edulab_id->key = 'id';
}


                if ($candidate_edulab_id->value == $_POST['edulab_id']) {

                    $notification = false;
                } else {
                    $notification = true;
                     $candidate_edulab_id->value = $_POST['edulab_id'];
                }
               
                if ($candidate_edulab_id->save())
                {
                    if($notification) {
                        Yii::$app->session->addFlash('success','edulab_id saved');
                    }

                } else {
                    var_dump($candidate_edulab_id->errors);
                }


    }


        if(isset($_POST['ed_level'])) {

$candidate_ed_level = ProfileExtended::find()->andWhere(['user_id' => Yii::$app->user->id])->andWhere(['type'=>'edulab'])->andWhere(['key' => 'ed_level'])->One();
if (null !== $candidate_ed_level) {
    
} else {
            $candidate_ed_level = new ProfileExtended();
            $candidate_ed_level->user_id = $model->user_id;
            $candidate_ed_level->type = 'edulab';
            $candidate_ed_level->key = 'ed_level'; #not using candidate now
}
                if ($candidate_ed_level->value == $_POST['ed_level']) {

                    $notification = false;
                } else {
                    $notification = true;
                     $candidate_ed_level->value = $_POST['ed_level'];
                }
               
                if ($candidate_ed_level->save())
                {
                    if($notification) {
                        Yii::$app->session->addFlash('success','education level saved');
                    }

                } else {
                    var_dump($candidate_ed_level->errors);
                }
    }

        if(isset($_POST['location'])) {

$candidate_location = ProfileExtended::find()->andWhere(['user_id' => Yii::$app->user->id])->andWhere(['type'=>'edulab'])->andWhere(['key' => 'location'])->One();
if (null !== $candidate_location) {
} else {
            $candidate_location = new ProfileExtended();
            $candidate_location->user_id = $model->user_id;
            $candidate_location->type = 'edulab';
            //$candidate_location->key = 'candidate_location';
                        $candidate_location->key = 'location';
}

                if ($candidate_location->value == $_POST['location']) {

                    $notification = false;
                } else {
                    $notification = true;
                     $candidate_location->value = $_POST['location'];
                }
               
                if ($candidate_location->save())
                {
                    if($notification) {
                        Yii::$app->session->addFlash('success','location saved');
                    }

                } else {
                    var_dump($candidate_location->errors);
                }



    }
        if($_POST){
                         return $this->redirect(['profile']);
        }

        return $this->render('profile.php', [
                'model' => $model,
	            'edlevel' => $edlevelmodel,
                'location' => $location->value,
	            'avatarmodel' => $avatarmodel,
	            'imageuploadmodel' => $imageuploadmodel,
                'email' => $email,
                'mobile' => $mobile->value,
                'home' => $home->value,
                'work' => $work->value,
                'home_address' => $home_address->value,
                'work_address' => $work_address->value,
                'edulab_id' => $edulab_id->value,
                'timezone' => $timezone->value,
                'profile_location' => $profile_location->value,
                'email_verification' => $emailverification[0],
                //'verified' => $verified,

            ]);





}

  

}
