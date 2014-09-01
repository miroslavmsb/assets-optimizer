<?php

/**
 * Description of Compressor
 * @depends Yui compressor
 * @author Miroslav Milosevic <m.maksa@gmail.com>
 */

namespace MM\Compressor;

class Compressor {
    
    private $config;
    
    public function __construct(\MM\Config\Config $config) {
        $this->config = $config;
    }
    
    public function compressCSS()
    {
        echo "Compressing styles\n";
        $config = $this->config->getConfig();
        $this->clear('css');
        exec("java -jar ".BASE_DIR.$config->compressorPath.' '.BASE_DIR.$config->combinedCssName.' -o '.BASE_DIR.$config->outputCssDir.$config->compressedCssName.' --type css');
        echo "Finished compressing styles\n";
    }
    
    public function compressJS()
    {
        echo "Compressing javascript\n";
        $config = $this->config->getConfig();
        $this->clear('js');
        exec("java -jar ".BASE_DIR.$config->compressorPath.' '.BASE_DIR.$config->combinedJsName.' -o '.BASE_DIR.$config->outputJsDir.$config->compressedJsName.' --type js');
        echo "Finished compressing javascript\n";
    }
    
    private function clear($type = "css")
    {
        $config = $this->config->getConfig();
        echo "Running clear function\n";
        
        if($type == "css") {
            exec("rm -rf ".BASE_DIR.$config->outputCssDir.$config->compressedCssName);
        }
        
        if($type == "js") {
            exec("rm -rf ".BASE_DIR.$config->outputJsDir.$config->compressedJsName);
        }
        
        echo "Running clear function finished\n";
    }
    
}
