<?php

/** AUTOLOAD DAS CLASSES INSTANCIADAS */
spl_autoload_register(
    function($Class)
    {
        $dir = ['_app','_app/CRUD','_controller','_view'];
        $iDir = false;

        foreach($dir as $dirName)
        {
            $classDir = __DIR__.'/'.$dirName.'/'.$Class.'.class.php';

            if(file_exists($classDir)):
                require_once($classDir);
                $iDir = true;
            endif;
        }

        if(!$iDir):
            trigger_error("Não foi possivel incluir {$Class}.class.php", E_USER_ERROR);
            die;
        endif;
    }
);

/** URL AMIGAVEL */
$GetUrl = strip_tags(trim(filter_input(INPUT_GET, 'url', FILTER_DEFAULT)));
$SetUrl = (empty($GetUrl) ? 'home' : $GetUrl);
$Url = explode('/', $SetUrl);

//** INFORMAÇÕES DO SITE */
define('SITE_URL','//localhost/previsa');
define('THEME_COLOR','#FFE529');

/** CONFIGURAÇÕES DA BASE DE DADOS */
define('HOST','localhost');
define('USER','root');
define('PASS','');
define('DBSA','empresa');