<?php
/**
 * <kbd>SWL_View_Decorator_Tag</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_View_Decorator
 * @package     SWL_View_Decorator_Tag
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once 'SWL/View/Decorator.php'; 

/**
 * Tag decorator class
 *
 * @category    SWL_View_Decorator
 * @package     SWL_View_Decorator_Tag
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_View_Decorator_Tag extends SWL_View_Decorator  {
    
    protected $tag;
    
    protected $attributes = array();
    
    
    public function __construct($tag, $attributes = array()) {    
        parent::__construct('Tag');
        $this->tag = $tag;
        $this->attributes = $attributes;
    }
    
    public function decorate($html) {
        $output = '<'.$this->tag;
        foreach ($this->attributes as $name => $value) {
            $output .= ' '.$name.'="'.esc_attr($value).'"';
        }
        $output .= '>';
        $output .= $html;
        $output .= '</'.$this->tag.'>';
        return $output;
    }
    
}