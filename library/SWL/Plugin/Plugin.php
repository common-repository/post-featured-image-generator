<?php
/**
 * <kbd>SWL_Plugin</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL
 * @package     SWL_Plugin
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once 'SWL/Action/Manager.php';
require_once 'SWL/Filter/Manager.php';

/**
 * Plugin base class
 *
 * @category    SWL
 * @package     SWL_Plugin
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_Plugin {
    
    protected $version = '0.0.1';
    
    protected $name;
    
    public function __construct() {
        if (!session_id()) session_start();
        $optionBaseName = str_replace(' ', '_', strtolower($this->name));
        if (get_option($optionBaseName.'_installed', false)===false) {
            $this->install();
        } else { //check for migration
            
        }
        $this->registerActions();
        $this->registerFilters();
    }
    
    public function registerActions() {
        
    }  
    
    public function registerFilters() {
        
    }      

    public function init() {
        SWL_Action_Manager::getInstance()->init();
        SWL_Filter_Manager::getInstance()->init();
    }
    
    public function install() {
        $optionBaseName = str_replace(' ', '_', strtolower($this->name));
        add_option($optionBaseName.'_installed', $this->version);
    }
    
}

