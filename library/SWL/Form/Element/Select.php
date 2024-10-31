<?php
/**
 * <kbd>SWL_Form_Element_Select</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_Form_Element
 * @package     SWL_Form_Element_Select
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once __DIR__ .'/../Element.php';
require_once __DIR__ .'/Renderer/Select.php';

/**
 * Textarea element
 *
 * @category    SWL_Form_Element
 * @package     SWL_Form_Element_Select
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_Form_Element_Select extends SWL_Form_Element{
    
    protected $options = array();    
    
    public function __construct($name, $value = '', $label = '', $options = array(), $attributes = array(), $settings = array()) {    
        $this->options = $options;
        parent::__construct('select', $name, $value, $label, $attributes, $settings);
        $this->setRenderer(new SWL_Form_Element_Renderer_Select($this, isset($settings['renderer'])?$settings['renderer']:array()));
    }
    
    public function getOptions() {
        return $this->options;
    }
    
}