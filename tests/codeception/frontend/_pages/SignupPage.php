<<<<<<< HEAD
<?php

namespace tests\codeception\frontend\_pages;

use yii\codeception\BasePage;
use frontend\models\SignupForm;

/**
 * Represents signup page
 * @property \codeception_frontend\AcceptanceTester|\codeception_frontend\FunctionalTester $actor
 */
class SignupPage extends BasePage
{

    public $route = 'site/signup';

    /**
     * @param array $signupData
     */
    public function submit(array $signupData)
    {
        $signupForm = new SignupForm;

        foreach ($signupData as $field => $value) {
            $inputType = $field === 'body' ? 'textarea' : 'input';
            $this->actor->fillField($inputType . '[name="' . $signupForm->formName() . '[' . $field . ']"]', $value);
        }
        $this->actor->click('signup-button');
    }
}
=======
<?php

namespace tests\codeception\frontend\_pages;

use yii\codeception\BasePage;
use frontend\models\SignupForm;

/**
 * Represents signup page
 * @property \codeception_frontend\AcceptanceTester|\codeception_frontend\FunctionalTester $actor
 */
class SignupPage extends BasePage
{

    public $route = 'site/signup';

    /**
     * @param array $signupData
     */
    public function submit(array $signupData)
    {
        $signupForm = new SignupForm;

        foreach ($signupData as $field => $value) {
            $inputType = $field === 'body' ? 'textarea' : 'input';
            $this->actor->fillField($inputType . '[name="' . $signupForm->formName() . '[' . $field . ']"]', $value);
        }
        $this->actor->click('signup-button');
    }
}
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
