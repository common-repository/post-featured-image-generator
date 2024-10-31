<?php
/**
 * <kbd>SWL_View_Element_Form_Boolean</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_View_Element_Form
 * @package     SWL_View_Element_Form_Boolean
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once 'SWL/View/Element/Form/Checkbox.php';
require_once 'SWL/View/Renderer/Form/Boolean.php';

/**
 * Boolean element
 *
 * @category    SWL_View_Element_Form
 * @package     SWL_View_Element_Form_Boolean
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_View_Element_Form_Boolean extends SWL_View_Element_Form_Checkbox {
    
    protected $attributes = array('checked' => true);
    
    public function __construct($name, $attributes = array(), $options = array()) {    
        parent::__construct($name, 1, $attributes, $options);
        $this->setRenderer(new SWL_View_Renderer_Form_Boolean($this));
    }
    
}

