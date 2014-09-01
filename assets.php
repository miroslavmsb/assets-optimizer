<?php 

/**
 * Testing assets optimizer
 * @author Miroslav Milosevic <m.maksa@gmail.com>
 */

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

/**
 * Create assets loader instance
 * 
 * $env - in case that env is different from production (development, or etc..)
 * all assets (.css and .js) will be loaded separate
 * on production env all assets will be combined and compressed into two files .min.js and .min.css
 */
$env = "development";
$loader = new Loader($config, $env);

/* Output css file */
echo $loader->getCss();

/* Output js file */
echo $loader->getJs();