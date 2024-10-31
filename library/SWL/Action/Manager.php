<?php
/**
 * <kbd>SWL_Action_Manager</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_Action
 * @package     SWL_Action_Manager
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

/**
 * WP actions manager
 * 
 * @category    SWL_Action
 * @package     SWL_Action_Manager
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_Action_Manager {
    
    protected static $self;
    
    protected $actions = array();
    
    private function __construct() {}
    
    public function init() {        
        foreach ($this->actions as $id => $action) {
            $action->init();
            unset($this->actions[$id]); //removed inited action to avoid duplicates during next initialization
        }
    }
    
    public function addAction(SWL_Action $action, $lateInit = false) {
        if ($lateInit) $this->actions[] = $action;
        else $action->init();
    }    
    
    public static function getInstance() {
        if ((self::$self instanceof self)===false) {
            self::$self = new self();
        }
        return self::$self;
    }
    
}