<?php 

/* Require Autoloader */
require_once 'src/MM/Autoloader.php';

define("BASE_DIR", __DIR__);
//print_R(BASE_DIR);die();

use MM\Autoloader;

$autoloader = Autoloader::register();

use MM\Config\Config;
use MM\AssetsLoader\Loader;
use MM\Combiner\Combiner;

/* Get configuration */
$config = new Config(__DIR__ . "/config/config.json");
//print_r($config->getConfig());

//$loader = new Loader($config);

/* Combine all assets (.css and .js) into one file */
//$combiner = new Combiner($config);
//$combiner->combineAssets();
//
//$compressor = new \MM\Compressor\Compressor($config);
//$compressor->compressCSS();
//$compressor->compressJS();

$loader = new Loader($config);

echo $loader->getCss();
echo $loader->getJs();