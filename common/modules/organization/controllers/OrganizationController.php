<<<<<<< HEAD
<?php

namespace common\modules\organization\controllers;

use common\modules\organization\models\Organization;	
use yii\web\Controller;

/**
 * Default controller for the `organization` module
 */
class OrganizationController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionProfile($org_id)
    {
    	$org = Organization::findOne($org_id);

        return $this->render('profile',[
        	'org' => $org,
        	]);
    }
}
=======
<?php

namespace common\modules\organization\controllers;

use common\modules\organization\models\Organization;	
use yii\web\Controller;

/**
 * Default controller for the `organization` module
 */
class OrganizationController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionProfile($org_id)
    {
    	$org = Organization::findOne($org_id);

        return $this->render('profile',[
        	'org' => $org,
        	]);
    }
}
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
