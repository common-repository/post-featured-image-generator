<?php
/**
 * <kbd>SWL_Alert_Manager</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_Alert
 * @package     SWL_Alert_Manager
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

/**
 * Alert manager class
 *
 * @category    SWL_Alert
 * @package     SWL_Alert_Manager
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_Alert_Manager {
    
    protected $alerts = array();
    
    protected static $self;
    
    protected function __construct() { 
        $this->init();
        $this->changePeriod();        
    }
    
    protected function init() {
        $alerts = isset($_SESSION['swl_alerts'])?unserialize($_SESSION['swl_alerts']):array();
        foreach ($alerts as $storage => $data) {
            foreach ($data as $alert) {                
                $this->addAlert($alert['item'], $storage, $alert['period']);
            }
        }
    }
    
    protected function changePeriod() {
        foreach ($this->alerts as $storage => &$data) {
            foreach ($data as $id => &$alert) {
                if ($alert['period']==-1) {
                    unset($this->alerts[$storage][$id]);
                } else {
                    $alert['period']--;
                }
            }
        }
        $_SESSION['swl_alerts'] = serialize($this->alerts);
    }
    
    public function addAlert(SWL_Alert $alert, $storage = 'default', $period = -1) {
        if (!isset($this->alerts[$storage])) $this->alerts[$storage] = array();
        $this->alerts[$storage][] = array('period' => $period, 'item' => $alert);
        $_SESSION['swl_alerts'] = serialize($this->alerts);    
    }
    
    public function getCurrent($storage = 'default') {
        $alerts = array();
        if (isset($this->alerts[$storage])) {
            foreach ($this->alerts[$storage] as $alert) {
                if ($alert['period']==-1) $alerts[] = $alert['item'];
            } 
        }
        return $alerts;
    }
    
    public function display($storage = 'default') {
        $alerts = $this->getCurrent($storage);
        foreach ($alerts as $alert) {
            $alert->render();
        }
    }
    
    public static function getInstance() {
        if ((self::$self instanceof self)===false) {
            self::$self = new self();
        }
        return self::$self;
    }    
    
}