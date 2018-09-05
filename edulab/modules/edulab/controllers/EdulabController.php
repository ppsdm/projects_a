<?php

namespace app\modules\edulab\controllers;

use common\modules\profile\models\ProfileGeneral;
use common\modules\catalog\models\CatalogGeneral;
use common\modules\assessment\models\Assessment;
use common\modules\catalog\models\CatalogRelation;
use common\modules\profile\models\ProfileExtended;
use common\modules\profile\models\UserTransaction;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii;
use yii\base\InvalidConfigException;
use yii\base\DynamicModel;

use common\modules\ref\models\Log;
use app\models\ImageUpload;
use yii\db\Expression;
use yii\helpers\Url;
use yii\web\UploadedFile;

use common\models\LoginForm;
use common\models\User;
use common\models\Notification;
use common\modules\core\models\Message;
use app\models\SignupForm;

use common\models\EmailVerification;
use common\models\Token;

use bizley\podium\models\User as PodiumUser;
use bizley\podium\Podium as Podium;

use yii2mod\alert\Alert;

class EdulabController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'signup','emailverification', 'verifypage'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index','emailverification','verifypage'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            /*'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            */
        ];
    }
    

    public function actionTest()
    {
        Yii::$app->session->setFlash('success', 'This is the message');
         echo Alert::widget();
/*
        echo Alert::widget([
    'useSessionFlash' => false,
    'options' => [
        'timer' => null,
        'type' => \yii2mod\alert\Alert::TYPE_INPUT,
        'title' => 'An input!',
        'text' => "Write something interesting",
        'confirmButtonText' => "Yes, delete it!",
        'closeOnConfirm' => false,
        'showCancelButton' => true,
        'animation' => "slide-from-top",
        'inputPlaceholder' => "Write something"
    ],
    'callback' => new \yii\web\JsExpression(' function(inputValue) { 
                if (inputValue === false) return false;      
                if (inputValue === "") { 
                    swal.showInputError("You need to write something!");     
                    return false;   
                }      
                swal("Nice!", "You wrote: " + inputValue, "success"); 
    }')
]);

*/
         return $this->render('help');

    }
    public function actionHelp()
    {
     return $this->render('help');
    }


    public function actionReward()
    {

$userprofile2 = ProfileExtended::find()->andWhere(['user_id'=>Yii::$app->user->id])->andWhere(['type' => 'edulab'])
->andWhere(['key' => 'ed_level'])->One();

$user_profile_tag2 = isset($userprofile2->value) ? strtolower($userprofile2->value) : '';

$tags_array2 = [','.$user_profile_tag2.','];
        $search = '';
        if (Yii::$app->request->post()) {
            $search2 = $_POST['search'];
                 array_push($tags_array2, ','.$search2.',');
        }
$status_array2 = ['active', 'inactive', 'pending'];
$catalogs_query2 = CatalogGeneral::find()
->andWhere(['in', 'type',['reward']])
->andWhere(['like','tag',$tags_array2])
->andWhere(['in', 'status', $status_array2])
;

    $dataProvider2 = new ActiveDataProvider([
    'query' => $catalogs_query2,
    'pagination' => [
        'pageSize' => 20,
    ],
]);


            $reward = ProfileExtended::find()
            ->andWhere(['user_id' => Yii::$app->user->id])
            ->andWhere(['type' => 'edulab'])
            ->andWhere(['key' => 'reward'])
            ->One();


            if(null == $reward) {
                $rewardpoint = 0;
            } else {
                $rewardpoint = $reward->value;
            }

            $redeems = UserTransaction::find()
                        ->andWhere(['user_id' => Yii::$app->user->id])
                                    ->andWhere(['credit_type' => 'reward'])
  ->andWhere(['transaction_type' => 'redeem']);
      
      $dataProvider = new ActiveDataProvider([
    'query' => $redeems,
    'pagination' => [
        'pageSize' => 20,
    ],
]);
//echo '<br/><br/><br/><br/>';
//print_r($tags_array2);
                return $this->render('reward',['rewardpoint' => $rewardpoint, 'dataProvider' => $dataProvider,'dataProvider2' => $dataProvider2]);
    }
    public function actionResendverification($email)
    {

$factory = new \RandomLib\Factory;
$generator = $factory->getGenerator(new \SecurityLib\Strength(\SecurityLib\Strength::MEDIUM));
        $emailtobeverified = EmailVerification::find()->andWhere(['user_id' => Yii::$app->user->id])
        ->andWhere(['email' => $email])->One();





$a =$generator->generateString(6, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
$b = $generator->generateString(32,'0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');

                $emailtobeverified->verification_string = $a;
                  $emailtobeverified->modified_at = new Expression('NOW()');
                $emailtobeverified->save();

        
            $token = Token::find()
            ->andWhere(['user_id' => Yii::$app->user->id])
            ->andWhere(['type' => 'email'])
            ->One();
               
                if (null== $token) {
                              $token = new Token;
                                $token->user_id = Yii::$app->user->id;
                $token->type = 'email';
                $token->created_at = new Expression('NOW()');
            } else {

            }
            $token->code = $b;
              $token->modified_at = new Expression('NOW()');
                $token->save();

$verifyURL = Url::toRoute('edulab/emailverification?verifyemail='.$email.'&verifykey=' . $b, true);
$manualverifyURL = Url::toRoute('edulab/verifypage', true);
$html_message = 'Congratulations '.Yii::$app->user->identity->profile->first_name.'!. Your verification key is : <h2>' . $a .' </h2><br/> Click here to verify your email : ' . $verifyURL .' <br/> Or you can enter your verification key manually here : ' . $manualverifyURL;


        Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([Yii::$app->params['adminEmail'] => 'Admin'])
            ->setSubject('Signup')
            //->setTextBody($text_message)
                        ->setHtmlBody($html_message)
            ->send();
        
              Yii::$app->session->addFlash('success', 'Resend Email Verification');

//echo Yii::$app->user->identity->profile->first_name;
 return $this->goBack((!empty(Yii::$app->request->referrer) ? Yii::$app->request->referrer : null));


    }


    public function actionEmailverification($verifyemail, $verifykey)
    {

            $emailverification = EmailVerification::find()
            ->andWhere(['user_id' => Yii::$app->user->id])
            ->andWhere(['email' => $verifyemail])
            //->andWhere(['verification_string' => $verifykey])
            ->andWhere(['status' => 'unverified'])
            ->One();

            $token = Token::find()
            ->andWhere(['user_id' => Yii::$app->user->id])
            ->andWhere(['code' => $verifykey])
            ->andWhere(['type' => 'email'])
            ->One();

            if(null !== $emailverification) {
                            if(null !== $token) {
                    $user = User::find()->andWhere(['id' => Yii::$app->user->id])->One();
                    $user->email = $emailverification->email;


                    try
             {

        $user->save();

                    $emailverification->status = 'verified';
                    $emailverification->modified_at = new Expression('NOW()');
                    $emailverification->save();
$podiumuser = PodiumUser::findMe();
                    if (empty($podiumuser)) {
                        if (!PodiumUser::createInheritedAccount()) {
                            throw new InvalidConfigException('There was an error while creating inherited user account. Podium can not run with the current configuration. Please contact administrator about this problem.');
                        } else {
                            echo 'create podium';
                        }
                    } elseif (!PodiumUser::updateInheritedAccount()) {
                        throw new InvalidConfigException('There was an error while updating inherited user account. Podium can not run with the current configuration. Please contact administrator about this problem.');
                    }


             Yii::$app->session->addFlash('success', 'Email Verification Success!');
                    return $this->redirect('index');
                }                     

                catch(\Exception $e){ 
                     throw new \yii\web\HttpException(405, 'Email Verification failed! Duplicate email! This email has been verified by another user'); 
                                 //Yii::$app->session->addFlash('danger', 'Email Verification failed! Duplicate email!');
                 //   return $this->redirect('index');
                }
                    
                }
            }

echo 'INVALID VERIFICATION KEY! EMAIL NOT VERIFIED';
/*
            echo Yii::$app->user->id;
            echo '<br/>' . $verifyemail . '<br/>';
            echo $verifykey;
            */
                //return $this->render('email_verification');
    }
    public function actionVerifypage()
    {
            $emailtobeverified = EmailVerification::find()
            ->andWhere(['user_id' => Yii::$app->user->id])
            ->andWhere(['status' => 'unverified'])->One();
            //echo $verifykey;

            if(Yii::$app->request->post()) {
                if ($_POST['verification_string'] == $emailtobeverified->verification_string) {

                                        try
             {

                    $emailtobeverified->status = 'verified';
                    $emailtobeverified->modified_at = new Expression('NOW()');
                    $emailtobeverified->save();
                $user = User::find()->andWhere(['id' => Yii::$app->user->id])->One();
                    $user->email = $emailtobeverified->email;
                    $user->save();
$podiumuser = PodiumUser::findMe();
                    if (empty($podiumuser)) {
                        if (!PodiumUser::createInheritedAccount()) {
                            throw new InvalidConfigException('There was an error while creating inherited user account. Podium can not run with the current configuration. Please contact administrator about this problem.');
                        }
                    } elseif (!PodiumUser::updateInheritedAccount()) {
                        throw new InvalidConfigException('There was an error while updating inherited user account. Podium can not run with the current configuration. Please contact administrator about this problem.');
                    }
                    Yii::$app->session->addFlash('success', 'email have been verified');
                    return $this->redirect('index');
                } catch(\Exception $e){ 
                     throw new \yii\web\HttpException(405, 'Email Verification failed! Duplicate email! This email has been verified by another user'); 
                                 //Yii::$app->session->addFlash('danger', 'Email Verification failed! Duplicate email!');
                 //   return $this->redirect('index');
                }

                } else {
                       Yii::$app->session->addFlash('warning', 'verification_string does not match');
                }
            }

            if (null !== $emailtobeverified) {
                return $this->render('email_verification');
            }
            else {
Yii::$app->session->addFlash('warning', 'You dont have unverified emails');
            }
    }


    public function actionIndex()
    {


        return $this->render('index');
    }

    public function actionChangepassword()
    {
        $model = User::findOne(Yii::$app->user->id);
        if(Yii::$app->request->post()) {
            if($model->validatePassword($_POST['old_password'])){

                $old_password = $_POST['old_password'];
                $new_password = $_POST['new_password'];
                $password_repeat = $_POST['confirm_password'];

                //$model->setPassword
                $validationmodel = DynamicModel::validateData(compact('new_password', 'password_repeat'), [
            ['new_password', 'required'],
                ['new_password', 'match', 'pattern' => '/^[a-z][a-z0-9_.]*$/', 'message' => 'password is invalid. password have to be min 6 lowercase alphanumeric and underscore'],
            ['new_password', 'string', 'min' => 6],

            ['password_repeat', 'required'],
            ['new_password', 'compare', 'compareAttribute' => 'password_repeat'],
            ]);

                if($validationmodel->hasErrors()) {
      
             
                foreach ($validationmodel->errors as $key => $values) {
                        foreach ($values as $key1 => $value1) {
                            # code...
                               Yii::$app->session->addFlash('warning', $key . ' : ' . $value1);
                        }
                     
                }
                } else {
                            $model->setPassword($new_password);
                            $model->save();
                              Yii::$app->session->setFlash('success', 'password changed!');
                }
            } else {
          Yii::$app->session->setFlash('warning', 'password do not match!');
            }
        }

        return $this->render('changepassword');
    }

    public function actionNotificationtest()
    {

        // $message was just created by the logged in user, and sent to $recipient_id
Notification::notify(Notification::KEY_NEW_MESSAGE, '52', 1);
//Notification::warning(Notification::KEY_NEW_MESSAGE, '52', 1);

// You may also use the following static methods to set the notification type:
//Notification::warning(Notification::KEY_NEW_MESSAGE, $recipient_id, $message->id);
//Notification::success(Notification::ORDER_PLACED, $admin_id, $order->id);
//Notification::error(Notification::KEY_NO_DISK_SPACE, $admin_id);


    }
    public function actionSignup()
    {
    	 $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {

            if ($user = $model->signup()) {

                            $type = 'edulab';
            //$add_user_result = true;
             $add_user_result = Yii::$app->runAction('tao/adduser', ['userid' => $user->id, 'password' => $model->password, 'type' => $type]);






			if($add_user_result) {
			 Yii::$app->session->setFlash('success', 'Signup Success! A verification email has been sent to you.');
                //if (Yii::$app->getUser()->login($user)) {
			    //return $this->redirect('index');
             return $this->goHome();
                //}
			} else {
			                           Yii::$app->session->setFlash('danger', 'User is created but not registered to TAO');
			}

			                
			            }


			        }

			        return $this->render('signup', [
			            'model' => $model,
			        ]);
	}

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {

            if($model->login()) {
                        return $this->redirect('index');

            } else {
                        return $this->render('login', [
                'model' => $model,
            ]);
        }


        }
            return $this->render('login', [
                'model' => $model,
            ]);
    }




	public function actionLoginpop()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {

            if($model->login()) {
                        return $this->redirect('index');

            } else {
                        return $this->render('loginpop', [
                'model' => $model,
            ]);
        }


        }
            return $this->renderPartial('loginpop', [
                'model' => $model,
            ]);
    }

    public function actionMateri()
    {  
        $userprofile = ProfileExtended::find()->andWhere(['user_id'=>Yii::$app->user->id])->andWhere(['type' => 'edulab'])
        ->andWhere(['key' => 'ed_level'])->One();

        $user_profile_tag = isset($userprofile->value) ? strtolower($userprofile->value) : '';

        $tags_array = [','.$user_profile_tag.','];
        $search = '';
        if (Yii::$app->request->post()) {
            $search = $_POST['search'];
                 array_push($tags_array, ','.$search.',');
        }
        $status_array = ['active', 'inactive', 'pending'];
        $catalogs_query = CatalogGeneral::find()
        ->andWhere(['in', 'type',['materi']])
        ->andWhere(['like','tag',$tags_array])
        ->andWhere(['in', 'status', $status_array])
        ;

        $dataProvider = new ActiveDataProvider([
        'query' => $catalogs_query,
        'pagination' => [
            'pageSize' => 20,
        ],
        ]);

        return $this->render('materi',                [
            'dataProvider' => $dataProvider,
            //'materisearch' => $materisearches,
        ]);
    }

    public function actionSoal()
    {
$userprofile = ProfileExtended::find()->andWhere(['user_id'=>Yii::$app->user->id])->andWhere(['type' => 'edulab'])
->andWhere(['key' => 'ed_level'])->One();

$user_profile_tag = isset($userprofile->value) ? strtolower($userprofile->value) : '';

$tags_array = [','.$user_profile_tag.','];
        $search = '';
        if (Yii::$app->request->post()) {
            $search = $_POST['search'];
                 array_push($tags_array, ','.$search.',');
        }
$status_array = ['active', 'inactive', 'pending'];
$catalogs_query = CatalogGeneral::find()
->andWhere(['in', 'type',['soal']])
->andWhere(['like','tag',$tags_array])
->andWhere(['in', 'status', $status_array])
;

    $dataProvider = new ActiveDataProvider([
    'query' => $catalogs_query,
    'pagination' => [
        'pageSize' => 20,
    ],
]);

        return $this->render('soal',
                [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionVideoseries($id)
    {
        $query = CatalogRelation::find()
        //->where(['in', 'type',['video','video-series']])
        ->andWhere(['object' => $id])
        ->andWhere(['predicate' => 'video'])
        //->all()
        ;
        return $this->render('videoseries', 
        [
            'query' => $query,
        ]);
    }


    public function actionVideo()
    {

$userprofile = ProfileExtended::find()->andWhere(['user_id'=>Yii::$app->user->id])->andWhere(['type' => 'edulab'])
->andWhere(['key' => 'ed_level'])->One();

$user_profile_tag = isset($userprofile->value) ? strtolower($userprofile->value) : '';

$tags_array = [','.$user_profile_tag.','];
        $search = '';
        if (Yii::$app->request->post()) {
            $search = $_POST['search'];
                 array_push($tags_array, ','.$search.',');
        }
$status_array = ['active', 'inactive', 'pending'];
$catalogs_query = CatalogGeneral::find()
->andWhere(['in', 'type',['video']])
->andWhere(['like','tag',$tags_array])
->andWhere(['in', 'status', $status_array])
;

    $dataProvider = new ActiveDataProvider([
    'query' => $catalogs_query,
    'pagination' => [
        'pageSize' => 20,
    ],
]);

        return $this->render('video',
                [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionMessage()
    {


        $query = Message::find();
        return $this->render('message', 
        [
            'query' => $query,
        ]);
    }
    public function actionIpcsignup($year)
    {
            $ipc_registration = new ProfileExtended();
            $ipc_registration->user_id = Yii::$app->user->id;
            $ipc_registration->type = 'edulab';
            $ipc_registration->key = 'ipc-registration';
                        $ipc_registration->value = 'true';
            $ipc_registration->attribute_1 = $year;
            $ipc_registration->save();
             Yii::$app->session->setFlash('success', 'IPC signup success!');
//return $this->redirect(Yii::$app->request->referrer);
                return $this->redirect(['tryout']);

    }

    public function actionAssessment()
    {


$userprofile = ProfileExtended::find()->andWhere(['user_id'=>Yii::$app->user->id])->andWhere(['type' => 'edulab'])
->andWhere(['key' => 'ed_level'])->One();

$user_profile_tag = isset($userprofile->value) ? strtolower($userprofile->value) : '';

$tags_array = [','.$user_profile_tag.','];
        $search = '';
        if (Yii::$app->request->post()) {
            $search = $_POST['search'];
                 array_push($tags_array, ','.$search.',');
        }
$status_array = ['active', 'inactive', 'pending'];
$catalogs_query = CatalogGeneral::find()
->andWhere(['type' => 'assessment'])
->andWhere(['like','tag',$tags_array])
->andWhere(['in', 'status', $status_array])
;

    $dataProvider = new ActiveDataProvider([
    'query' => $catalogs_query,
    'pagination' => [
        'pageSize' => 20,
    ],
]);

        return $this->render('assessment',
                [
            'dataProvider' => $dataProvider,
        ]);

    }
    public function actionBakatminat()
    {


$userprofile = ProfileExtended::find()->andWhere(['user_id'=>Yii::$app->user->id])->andWhere(['type' => 'edulab'])
->andWhere(['key' => 'ed_level'])->One();

$user_profile_tag = isset($userprofile->value) ? strtolower($userprofile->value) : '';

$tags_array = [','.$user_profile_tag.','];
        $search = '';
        if (Yii::$app->request->post()) {
            $search = $_POST['search'];
                 array_push($tags_array, ','.$search.',');
        }
$status_array = ['active', 'inactive', 'pending'];
$catalogs_query = CatalogGeneral::find()
->andWhere(['type' => 'bakatminat'])
->andWhere(['like','tag',$tags_array])
->andWhere(['in', 'status', $status_array])
;

    $dataProvider = new ActiveDataProvider([
    'query' => $catalogs_query,
    'pagination' => [
        'pageSize' => 20,
    ],
]);

        return $this->render('bakatminat',
                [
            'dataProvider' => $dataProvider,
        ]);

    }

    public function actionCourse()
    {


$userprofile = ProfileExtended::find()->andWhere(['user_id'=>Yii::$app->user->id])->andWhere(['type' => 'edulab'])
->andWhere(['key' => 'ed_level'])->One();

$user_profile_tag = isset($userprofile->value) ? strtolower($userprofile->value) : '';

$tags_array = [','.$user_profile_tag.','];
        $search = '';
        if (Yii::$app->request->post()) {
            $search = $_POST['search'];
                 array_push($tags_array, ','.$search.',');
        }
$status_array = ['active', 'inactive', 'pending'];
$catalogs_query = CatalogGeneral::find()
->andWhere(['type' => 'course'])
->andWhere(['like','tag',$tags_array])
->andWhere(['in', 'status', $status_array])
;

    $dataProvider = new ActiveDataProvider([
    'query' => $catalogs_query,
    'pagination' => [
        'pageSize' => 20,
    ],
]);

        return $this->render('course',
                [
            'dataProvider' => $dataProvider,
        ]);

    }


    public function actionExercise()
    {


$userprofile = ProfileExtended::find()->andWhere(['user_id'=>Yii::$app->user->id])->andWhere(['type' => 'edulab'])
->andWhere(['key' => 'ed_level'])->One();

$user_profile_tag = isset($userprofile->value) ? strtolower($userprofile->value) : '';

$tags_array = [','.$user_profile_tag.','];
        $search = '';
        if (Yii::$app->request->post()) {
            $search = $_POST['search'];
                 array_push($tags_array, ','.$search.',');
        }
$status_array = ['active', 'inactive', 'pending'];
$catalogs_query = CatalogGeneral::find()
->andWhere(['type' => 'exercise'])
->andWhere(['like','tag',$tags_array])
->andWhere(['in', 'status', $status_array])
;

    $dataProvider = new ActiveDataProvider([
    'query' => $catalogs_query,
    'pagination' => [
        'pageSize' => 20,
    ],
]);

        return $this->render('exercise',
                [
            'dataProvider' => $dataProvider,
        ]);

    }
    public function actionTryout()
    {
        $model = CatalogGeneral::find()
        ->andWhere(['type' => 'assessment'])
        ->andWhere(['attribute1' => 'tryout'])
        ->all();



        $ipc_query = CatalogGeneral::find()
        ->andWhere(['type' => 'assessment'])
        ->andWhere(['attribute1' => 'tryout-ipc']);

    $ipcDataProvider = new ActiveDataProvider([
    'query' => $ipc_query,
    'pagination' => [
        'pageSize' => 20,
    ],
]);

        return $this->render('tryout',
                [
            'model' => $model,
            'ipcDataProvider' => $ipcDataProvider,
        ]);
    }

    public function actionReport()
    {
$userprofile = ProfileExtended::find()->andWhere(['user_id'=>Yii::$app->user->id])->andWhere(['type' => 'edulab'])
->andWhere(['key' => 'ed_level'])->One();

$user_profile_tag = isset($userprofile->value) ? strtolower($userprofile->value) : '';

$tags_array = [','.$user_profile_tag.','];

//$status_array = ['active', 'inactive', 'pending'];
        $status_array = ['active'];
$query = CatalogGeneral::find()
        ->andWhere(['type' => 'report'])
->andWhere(['like','tag',$tags_array])
->andWhere(['in', 'status', $status_array])
;


        $tryoutquery = CatalogGeneral::find()
        ->andWhere(['type' => 'assessment'])
        ->andWhere(['attribute1' => 'tryout']);


$current_assessment = Assessment::find()
//->andWhere(['catalog_id' => $model->id])
->orderBy(['id'=> SORT_DESC])
->andWhere(['user_id' => Yii::$app->user->id])
->andWhere(['in', 'status', ['active', 'finished']])
->All();


        return $this->render('report',
                [
            'query' => $query,
            'tryoutquery' => $tryoutquery,
        ]);
    }


/**
* Change email
*
* @return void
*/
public function actionChangeemail()
{
    $model = User::findOne(Yii::$app->user->id);
        
                 if(Yii::$app->request->post()) {

                    $newemail = $_POST['User']['email'];
                    $findexistingemail = User::find()->andWhere(['email' => $newemail])->One();
  
                    if (null == $findexistingemail) {
                        $model->email = null;
                        $model->save();

                        $newemailverification = EmailVerification::find()->andWhere(['user_id' => Yii::$app->user->id])
                        //->andWhere(['email' => $newemail])
                        ->One();
if (null !== $newemailverification) {
                        $newemailverification->email = $newemail;
                        $newemailverification->status = 'unverified';
                                          $newemailverification->modified_at = new Expression('NOW()');
} else {


                        $newemailverification = new EmailVerification;
                        $newemailverification->user_id = Yii::$app->user->id;
                        $newemailverification->email = $newemail;
                        $newemailverification->status = 'unverified';
                                          $newemailverification->created_at = new Expression('NOW()');
}

$factory = new \RandomLib\Factory;
$generator = $factory->getGenerator(new \SecurityLib\Strength(\SecurityLib\Strength::MEDIUM));

$a =$generator->generateString(6, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
$b = $generator->generateString(32,'0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');

                 // $newemailverification->created_at = new Expression('NOW()');

                $newemailverification->verification_string = $a;
                $newemailverification->save();

            $token = Token::find()
            ->andWhere(['user_id' => Yii::$app->user->id])
            ->andWhere(['type' => 'email'])
            ->One();
               
                if (null== $token) {
                              $token = new Token;
                                $token->user_id = Yii::$app->user->id;
                $token->type = 'email';
                $token->created_at = new Expression('NOW()');
            } else {

            }
            $token->code = $b;
              $token->modified_at = new Expression('NOW()');
                $token->save();





$verifyURL = Url::toRoute('edulab/emailverification?verifyemail='.$newemail.'&verifykey=' . $b, true);
$manualverifyURL = Url::toRoute('edulab/verifypage', true);
$html_message = 'Congratulations '.Yii::$app->user->identity->profile->first_name.'!. Your verification key is : <h2>' . $a .' </h2><br/> Click here to verify your email : ' . $verifyURL .' <br/> Or you can enter your verification key manually here : ' . $manualverifyURL;


        Yii::$app->mailer->compose()
            ->setTo($newemail)
            ->setFrom([Yii::$app->params['adminEmail'] => 'Admin'])
            ->setSubject('Signup')
            //->setTextBody($text_message)
                        ->setHtmlBody($html_message)
            ->send();
            
  Yii::$app->session->addFlash('success', 'Email is changed to' . $newemail . '. You have to verify this email first');
} else {
    Yii::$app->session->addFlash('warning', $newemail . ' is taken');
}

                 }

    return $this->render('changeemail',
               [
              'model' => $model
        ]);
}

/**
* Change username
*
* @return void
*/
public function actionChangeusername()
{
    $model = User::findOne(Yii::$app->user->id);
                 if(Yii::$app->request->post()) {

                    $newusername = $_POST['User']['username'];
                    $findexistingusername = User::find()->andWhere(['username' => $newusername])->One();
  
                    if (null == $findexistingusername) {
                        $model->username = $newusername;
                        $model->save();
                        
//$podiumuser = new PodiumUser;
$podiumuser = PodiumUser::findMe();
//$podiumuser = PodiumUser::find()->andWhere(['inherited_id' => Yii::$app->user->id])->One();
                    if (empty($podiumuser)) {
                        if (!PodiumUser::createInheritedAccount()) {
                            throw new InvalidConfigException('There was an error while creating inherited user account. Podium can not run with the current configuration. Please contact administrator about this problem.');
                        }
                    } elseif (!PodiumUser::updateInheritedAccount()) {
                        throw new InvalidConfigException('There was an error while updating inherited user account. Podium can not run with the current configuration. Please contact administrator about this problem.');
                    }
    
//return $this->redirect('updatepodium');

  Yii::$app->session->addFlash('success', 'Username changed to' . $newusername);
         return $this->redirect('../profile/profile');
     
} else {
    Yii::$app->session->addFlash('warning', $newusername . ' is taken');
}

                 }

    return $this->render('changeusername',
               [
         'model' => $model
        ]);
}
}
