<?php
/**
 * <kbd>SWL_Filter_Manager</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_Filter
 * @package     SWL_Filter_Manager
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

/**
 * WP filters manager
 * 
 * @category    SWL_Filter
 * @package     SWL_Filter_Manager
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_Filter_Manager {
    
    protected static $self;
    
    protected $filters = array();
    
    private function __construct() {}
    
    public function init() {        
        foreach ($this->filters as $id => $filter) {
            $filter->init();
            unset($this->filters[$id]); //removed inited filter to avoid duplicates during next initialization
        }
    }
    
    public function addFilter(SWL_Filter $filter, $lateInit = false) {
        if ($lateInit) $this->filter[] = $filter;
        else $filter->init();
    }    
    
    public static function getInstance() {
        if ((self::$self instanceof self)===false) {
            self::$self = new self();
        }
        return self::$self;
    }
    
}