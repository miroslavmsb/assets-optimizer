<?php

/**
 * Main config class
 * @author Miroslav Milosevic <m.maksa@gmail.com>
 */

namespace MM\Config;

class Config {
    
    /**
     * Configration file path
     * @var string
     */
    private $filePath;
    
    /**
     * @param string $filePath - path to configuration file
     */
    public function __construct($filePath) 
    {
        $this->filePath = $filePath;
    }
    
    /**
     * Get file extension from provided configuration file
     * @return string
     */
    private function getFileExtension()
    {
        $file = explode('.', $this->filePath);
        return $file[1];
    }
    
    /**
     * Get adapter method loads specific adapter based on config file extension
     * @return Adapter
     */
    private function getAdapter()
    {
        switch($this->getFileExtension())
        {
            case 'json':
                return new \MM\Config\Adapters\JsonAdapter($this->filePath);
                break;
            
        }
    }
    
    public function getConfig()
    {
        return $this->getAdapter()->getConfig();
    }
    
}