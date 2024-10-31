<?php
/**
 * <kbd>SWL_Form_Element_Radio</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_Form_Element
 * @package     SWL_Form_Element_Radio
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once __DIR__ .'/../Element.php';
require_once __DIR__ .'/Renderer/Radio.php';

/**
 * Radio element
 *
 * @category    SWL_Form_Element
 * @package     SWL_Form_Element_Radio
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_Form_Element_Radio extends SWL_Form_Element {
    
    protected $checked = false;
    
    public function __construct($name, $value, $checked = false, $label = '', $attributes = array(), $options = array()) {    
        $this->checked = $checked;
        parent::__construct('text', $name, $value, $label, $attributes, $options);
        $this->setRenderer(new SWL_Form_Element_Renderer_Radio($this, isset($options['renderer'])?$options['renderer']:array()));
    }
    
    public function isChecked() {
        return $this->checked;
    }
    
    public function checked($flag) {
        $this->checked = $flag;
    }
    
}

