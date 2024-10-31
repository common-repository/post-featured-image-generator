<?php
/**
 * <kbd>SWL_Form_Radiochoice</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_Form_Element
 * @package     SWL_Form_Radiochoice
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once __DIR__ .'/../Element.php';
require_once __DIR__ .'/Renderer/Radiochoice.php';
require_once __DIR__ .'/Radio.php';

/**
 * Radio group element
 *
 * @category    SWL_Form_Element
 * @package     SWL_Form_Radiochoice
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_Form_Element_Radiochoice extends SWL_Form_Element {
    
    protected $elements = array();
    
    public function __construct($name, $choices, $value = '', $label = '', $attributes = array(), $options = array()) {    
        parent::__construct('radiochoice', $name, $value, $label, $attributes, $options);
        $this->createElements($choices);
        $this->setRenderer(new SWL_Form_Element_Renderer_Radiochoice($this, isset($options['renderer'])?$options['renderer']:array()));
    }
    
    protected function createElements($choices) {
        foreach ($choices as $value => $label) {
            $this->elements[] = new SWL_Form_Element_Radio($this->name, $value, ($value==$this->value), $label);
        }
    }
    
    public function getElements() {
        return $this->elements;
    } 
    
    public function setValue($value) {
        parent::setValue($value);
        foreach ($this->elements as $element) {
            $element->checked($value==$element->getValue());
        }
    }
    
}