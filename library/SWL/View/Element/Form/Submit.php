<?php
/**
 * <kbd>SWL_View_Element_Form_Submit</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_View_Element_Form
 * @package     SWL_View_Element_Form_Submit
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once 'SWL/View/Element/Form/Element.php';

/**
 * Submit button element
 *
 * @category    SWL_View_Element_Form
 * @package     SWL_View_Element_Form_Submit
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_View_Element_Form_Submit extends SWL_View_Element_Form_Element {
    
    public function __construct($name = '', $label = '', $attributes = array(), $options = array()) {    
        parent::__construct('submit', $name, $label, $attributes, $options);

    }
    
}