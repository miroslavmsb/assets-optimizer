<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdapterAbstract
 *
 * @author miroslav
 */

namespace MM\Config\Adapters;

class AdapterAbstract {

    protected $configPath;
    protected $configuration;
    protected $fileContentBuffer;
    
    public function __construct($configPath = null) 
    {
        $this->configPath = $configPath;
        $this->loadConfigFile();
    }
    
    public function getConfig()
    {
        $this->parseConfig();
        return $this->configuration;
    }
    
    protected function loadConfigFile()
    {
        if(file_exists($this->configPath))
        {
            $this->fileContentBuffer = file_get_contents($this->configPath);
        }
        else 
        {
            throw new \Exception("File not found", 404);
        }
    }
    
    protected function parseConfig()
    {
        return $this->fileContentBuffer;
    }
    
}
