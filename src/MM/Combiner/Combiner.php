<?php

/**
 * Description of Combiner
 * @author Miroslav Milosevic <m.maksa@gmail.com>
 */

namespace MM\Combiner;

class Combiner {

    /**
     * Available commands for combine
     * @var array commands list
     */
    private $commands = array(
        "combineJs" => "*.js >> ",
        "combineCss" => "*.css > "
    );
    
    /**
     *
     * @var object config - this atribude holds configuration object
     */
    private $config;

    /**
     * @param \MM\Config\Config $config
     */
    public function __construct(\MM\Config\Config $config) 
    {
        $this->config = $config;
    }

    /**
     * Combine assets into one file (.js and .css)
     * This function requires using cat command 
     */
    public function combineAssets($type = "css")
    {
        /* Load configuration */
        $config = $this->config->getConfig();
        
        /* Clear tmp directory */
        $this->clearTmp($type);
        
        
        /* Combine css assets into one file */
        if($type == "css") {
            exec("cat ".BASE_DIR.$config->cssAssetsPath.$this->commands['combineCss'].BASE_DIR.$config->combinedCssName);
        }
        
        /* Combine js assets into one file*/
        if($type == "js") {
            exec("cat ".BASE_DIR.$config->jsAssetsPath.$this->commands['combineJs'].BASE_DIR.$config->combinedJsName);
        }
    }
    
    /**
     * Clear tmp directory from combined css and javascript files
     */
    private function clearTmp($type = "css") 
    {
        /* Load configuration */
        $config = $this->config->getConfig();
        
        /* Execute remove commands in linux shell */
        if($type == "css") {
            exec("rm -rf ".BASE_DIR.$config->combinedCssName);
        }
        if($type == "js") {
            exec("rm -rf ".BASE_DIR.$config->combinedJsName);
        }
    }

}
