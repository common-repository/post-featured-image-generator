<?php
/**
 * <kbd>SWL_Form_Element</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_Form
 * @package     SWL_Form_Element
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once __DIR__ . '/../View/Element.php';

/**
 * Form element
 *
 * @category    SWL_Form
 * @package     SWL_Form_Element
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
abstract class SWL_Form_Element extends SWL_View_Element {
    
    protected $name     = '';
    
    protected $value    = '';
    
    protected $label    = '';
    
    public function __construct($type, $name = '', $value = '', $label = '', $attributes = array(), $options = array()) {    
        parent::__construct($type, $attributes);
        $this->name         = $name;
        $this->value        = $value;
        $this->label        = $label;
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