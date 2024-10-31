<?php
/**
 * <kbd>SWL_View_Element_Form_Text</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_View_Element_Form
 * @package     SWL_View_Element_Form_Text
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once 'SWL/View/Element/Form/Element.php';

/**
 * Text element
 *
 * @category    SWL_View_Element_Form
 * @package     SWL_View_Element_Form_Text
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_View_Element_Form_Text extends SWL_View_Element_Form_Element {
    
    public function __construct($name, $value = '', $attributes = array(), $options = array()) {    
        parent::__construct('text', $name, $value, $attributes, $options);
    }
    
}

