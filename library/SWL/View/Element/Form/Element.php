<?php
/**
 * <kbd>SWL_View_Element_Form_Element</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_View_Element_Form
 * @package     SWL_View_Element_Form_Element
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once 'SWL/View/Element.php';
require_once 'SWL/View/Renderer/Form/Element.php';

/**
 * Form element
 *
 * @category    SWL_View_Element_Form
 * @package     SWL_View_Element_Form_Element
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_View_Element_Form_Element extends SWL_View_Element {
    
    protected $name     = '';
    
    protected $value    = '';
    
    protected $label    = '';
    
    protected $options = array();
    
    public function __construct($type, $name = '', $value = '', $attributes = array(), $options = array()) {    
        parent::__construct($type, $attributes);
        $this->name         = $name;
        $this->value        = $value;
        $this->label        = $label;
        $this->options      = array_merge($this->options, $options);
        $this->renderer     = new SWL_View_Renderer_Form_Element($this, $this->options);
    }
    
    public function getName() {
        return $this->name;
    } 
    
    public function getValue() {
        return $this->value;
    }
    
    public function getLabel() {
        return $this->label;
    }   
    
    public function setValue($value) {
        return $this->value = $value;
    }
    
}