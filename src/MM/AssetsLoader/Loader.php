<?php

/**
 * Assets loader class
 * @author Miroslav Milosevic <m.maksa@gmail.com>
 */

namespace MM\AssetsLoader;

use MM\Combiner\Combiner;
use MM\Compressor\Compressor;

class Loader {
    
    private $config;
    
    private $env;
    
    private $combiner;
    
    private $compressor;

    public function __construct(\MM\Config\Config $configuration, $env = "production")
    {
        $this->config = $configuration;
        $this->env = $env;
        $this->compressor = new Compressor($configuration);
        $this->combiner = new Combiner($configuration);
    }

    public function getCss()
    {
        $config = $this->config->getConfig();
        
        if($this->env == "production")
        {
            if(!file_exists(BASE_DIR.$config->outputCssDir.$config->compressedCssName)) {
                
                /* Combine css files */
                $this->combiner->combineAssets("css");

                /* Compress css file */
                $this->compressor->compressCSS();
                
                return $this->buildHtmlCSS($config->outputCssDir.$config->compressedCssName);
            }
            else {
                return $this->buildHtmlCSS($config->outputCssDir.$config->compressedCssName);
            }
        }
        else {
            return $this->buildHtmlCSS($config->cssFiles);
        }
    }
    
    public function getJs()
    {
        $config = $this->config->getConfig();
        
        if($this->env == "production")
        {
            if(!file_exists(BASE_DIR.$config->outputJsDir.$config->compressedJsName)) {
                
                /* Combine css files */
                $this->combiner->combineAssets("js");

                /* Compress css file */
                $this->compressor->compressJS();
//                return $this->buildHtmlJS($config->outputJsDir.$config->compressedJsName);
            }
            else {
                return $this->buildHtmlJS($config->outputJsDir.$config->compressedJsName);
            }
        }
        else {
            return $this->buildHtmlJS($config->jsFiles);
        }
    }
    
    private function buildHtmlCSS($file)
    {
        $config = $this->config->getConfig();
        
        if(is_array($file))
        {
            $links = "";
            foreach($file as $f) {
                $links .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"{$config->cssAssetsPath}{$f}\" />\n";
            }
            return $links;
        }
        else {
            return "<link rel=\"stylesheet\" type=\"text/css\" href=\"{$file}\" />";
        }
    }
    
    private function buildHtmlJS($file)
    {
        $config = $this->config->getConfig();
        
        if(is_array($file))
        {
            $links = "";
            foreach($file as $f) {
                $links .= "<script type=\"text/javascript\" src=\"{$config->cssAssetsPath}{$f}\"></script>\n";
            }
            return $links;
        }
        else {
            return "<script type=\"text/javascript\" src=\"{$file}\"></script>\n";
        }
    }
    
}
