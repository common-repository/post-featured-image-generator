<?php
/**
 * <kbd>SWL_Filter</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL
 * @package     SWL_Filter
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

/**
 * WP filters base class
 *
 * @category    SWL
 * @package     SWL_Filter
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_Filter {
    
    protected $function;
    
    protected $name;
    
    protected $priority = 10;
    
    protected $argsCount = 1;
    
    public function __construct($function, $name = '', $priority = 10, $argsCount = 1) {
        $this->function    = $function;
        $this->name        = $name;
        $this->priority    = $priority;
        $this->argsCount   = $argsCount;
        if ($this->name=='') $this->name = $this->generateName();
    }
    
    public function init() {        
        add_filter($this->name, $this->function, $this->priority, $this->argsCount);
    }
    
    public function getName() {
        return $this->name;
    }
    
    protected function generateName() {
        return 'swl_filter_'.wp_generate_password(10, false, false);
    }

    
}
