<?


use profaller\yiitrix\components\BitrixApplication;

define("P_APP",       "/local/");
define("P_ASSETS",       "/assets/");
define("P_CSS",       P_ASSETS . "css/");
define("P_JS",        P_ASSETS . "js/");
define("P_IMAGES",    P_ASSETS . "images/");
define("P_PICTURES",  P_ASSETS . "upload/");


define("P_LAYOUT",    P_APP . "layout/");

define("P_AJAX",      P_APP . "ajax/");
define("P_UPLOAD",    "/" . COption::GetOptionString("main", "upload_dir", "upload") . "/");

define("P_DR",        $_SERVER["DOCUMENT_ROOT"]);
define("P_APP_PATH",  P_DR . P_APP);
define("P_UPLOAD_PATH",     P_DR . P_UPLOAD);

define("P_BUNDLE_PATH",     P_APP_PATH . 'bundle/');
define("P_BUNDLE",          P_APP . 'bundle/');

define("P_INCLUDES",  P_APP_PATH . "includes/");
define("P_LIBRARY",   P_APP_PATH . "libs/");
define("P_CLASSES",   P_LIBRARY . "classes/");
define("P_MODELS",   P_LIBRARY . "models/");

define("P_LOG_DIR",   P_APP_PATH . "logs/");
define("P_LOG_FILE",  P_LOG_DIR . "app.log");

define("P_PARTIALS",  P_APP . "yii-app/views/partials/");
define("P_PARTIALS_PATH",  P_APP_PATH . "yii-app/views/partials/");

define('CACHE_LT', 3600*24*30);


class Yiitrix {

    public static function init() {
        AddEventHandler("main", "OnBeforeProlog", array("Yiitrix", "bootstrap"));
    }


    public static function bootstrap() {
        global $APPLICATION;

        if (defined('ADMIN_SECTION') && ADMIN_SECTION) {
            $APPLICATION->SetAdditionalCSS(P_CSS . 'admin/admin-small.css');
            $APPLICATION->AddHeadString("<script src='".P_JS."jquery-1.10.1.js'>\x3C/script>");

            if (in_array(5, explode(',', $GLOBALS['USER']->GetGroups()))) {
                $APPLICATION->AddHeadScript(P_JS . 'admin.js');
            }
        }

        //require P_LIBRARY . '/IblockAR/init.php';
        if (defined('ADMIN_SECTION') && ADMIN_SECTION) {

            \dev\ar\Generator::init();

        } else {

            define('YII_DEBUG', true);
            define('YII_ENV', 'dev');

            require(P_LIBRARY . 'yii2/Yii.php');

            $config = require(P_APP_PATH . 'yii-app/config/web.php');

            (new BitrixApplication($config))->run();
        }
    }
}
