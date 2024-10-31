<?php
/**
 * <kbd>SWL_Form_Element_Text</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_Form_Element
 * @package     SWL_Form_Element_Text
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once __DIR__ .'/../Element.php';
require_once __DIR__ .'/Renderer/Text.php';

/**
 * Textarea element
 *
 * @category    SWL_Form_Element
 * @package     SWL_Form_Element_Text
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_Form_Element_Text extends SWL_Form_Element {
    
    public function __construct($name, $value = '', $label = '', $attributes = array(), $options = array()) {    
        parent::__construct('text', $name, $value, $label, $attributes, $options);
        $this->setRenderer(new SWL_Form_Element_Renderer_Text($this, isset($options['renderer'])?$options['renderer']:array()));
    }
    
}

