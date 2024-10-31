<?php
/**
 * <kbd>SWL_View_Decorator</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_View
 * @package     SWL_View_Decorator
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

/**
 * Base decorator class
 *
 * @category    SWL_View
 * @package     SWL_View_Decorator
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
abstract class SWL_View_Decorator  {
    
    protected $name;
    
    public function __construct($name) {    
        $this->name = $name;
    }
    
    abstract public function decorate($html);
    
}