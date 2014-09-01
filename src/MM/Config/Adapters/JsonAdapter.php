<?php

/**
 * JSON Configuration adapter
 * @author Miroslav Milosevic <m.maksa@gmail.com>
 */

namespace MM\Config\Adapters;

use MM\Config\Adapters\AdapterAbstract;

class JsonAdapter extends AdapterAbstract {
    
    /**
     * Get configuration
     * @return object configuration
     */
    public function getConfig()
    {
        $this->parseConfig();
        return $this->configuration;
    }
    
    /**
     * Load configuration file in file buffer
     * @throws \Exceptiont
     */
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
    
    /**
     * Parse configuration file
     */
    protected function parseConfig()
    {
        $this->configuration = json_decode($this->fileContentBuffer);
    }
    
}
