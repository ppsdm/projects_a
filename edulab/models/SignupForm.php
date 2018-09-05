<?php
namespace app\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\modules\profile\models\ProfileExtended;
use common\modules\profile\models\ProfileGeneral;
use common\models\EmailVerification;
use common\models\Token;
use yii\db\Expression;
use yii\helpers\Url;
//use ircmaxell\RandomLib;
//use ircmaxell\SecurityLib;
/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
        public $password_repeat;
    public $first_name;
    public $last_name;
        public $birthdate;
        public $gender;
    //public $current_ed_level;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['first_name', 'trim'],
            ['first_name', 'string', 'min' => 0, 'max' => 255],

            ['last_name', 'trim'],
            ['last_name', 'string', 'min' => 0, 'max' => 255],

          //  ['current_ed_level', 'string'],
            ['gender', 'string'],
            ['birthdate', 'date','format' => 'php:Y-m-d'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
                ['password', 'match', 'pattern' => '/^[a-z][a-z0-9_.]*$/', 'message' => 'password is invalid. password have to be min 6 lowercase alphanumeric and underscore'],
            ['password', 'string', 'min' => 6],

                        ['password_repeat', 'required'],
            ['password', 'compare', 'compareAttribute' => 'password_repeat'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
      //  $user->email = $this->email;


        $user->setPassword($this->password);
        $user->generateAuthKey();
        $profile_edulab = new ProfileExtended;
        $profile_general = new ProfileGeneral;
        $email_verification = new EmailVerification;
                $token = new Token;
$result = $user->save();

                $profile_general->first_name = $this->first_name;
        $profile_general->last_name = $this->last_name;
        $profile_general->birthdate = $this->birthdate;
        $profile_general->gender = $this->gender;
                $profile_general->user_id = $user->id;
                $result = $profile_general->save();


$factory = new \RandomLib\Factory;
$generator = $factory->getGenerator(new \SecurityLib\Strength(\SecurityLib\Strength::MEDIUM));


$a =$generator->generateString(6, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
$b = $generator->generateString(32,'0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
$verifyURL = Url::toRoute('edulab/emailverification?verifyemail='.$this->email.'&verifykey=' . $b, true);
$manualverifyURL = Url::toRoute('edulab/verifypage', true);
$html_message = 'Congratulations ' .$this->first_name .'!. Your verification key is : <h2>' . $a .' </h2><br/> Click here to verify your email : ' . $verifyURL .' <br/> Or you can enter your verification key manually here : ' . $manualverifyURL;

                $email_verification->user_id = $user->id;
                $email_verification->email = $this->email;
                $email_verification->status = 'unverified';
                $email_verification->verification_string = $a;
                            $email_verification->created_at = new Expression('NOW()');
                $email_verification->save();

                $token->code = $b;
                $token->user_id = $user->id;
                $token->type = 'email';
                $token->created_at = new Expression('NOW()');
                $token->save();

/*
                $profile_edulab->user_id = $user->id;
                $profile_edulab->type = 'edulab';
                $profile_edulab->key = 'ed_level';
                $profile_edulab->value = $this->current_ed_level;
                $result = $profile_edulab->save();
                */


        Yii::$app->mailer->compose()
            ->setTo($this->email)
            ->setFrom([Yii::$app->params['adminEmail'] => 'Admin'])
            ->setSubject('Signup')
            //->setTextBody($text_message)
                        ->setHtmlBody($html_message)
            ->send();
        
        return $result ? $user : null;
    }





}
