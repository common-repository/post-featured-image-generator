<?php
/**
 * <kbd>SWL_Action_Ajax</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_Action
 * @package     SWL_Action_Ajax
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once __DIR__. '/Action.php';

/**
 * WP ajax actions class
 *
 * @category    SWL_Action
 * @package     SWL_Action_Ajax
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_Action_Ajax extends SWL_Action {
    
    protected $permission = 'all';
    
    public function __construct($function, $name = '', $permission = 'admin', $priority = 10, $argsCount = 1) {
        $this->permission = $permission;
        parent::__construct($function, $name, $priority, $argsCount);
    }
    
    public function init() {        
        add_action('wp_ajax_'.$this->name, $this->function, $this->priority, $this->argsCount);
        if ($this->permission=='all')
          add_action('wp_ajax_nopriv_'.$this->name, $this->function, $this->priority, $this->argsCount);  
    }    
    
}
