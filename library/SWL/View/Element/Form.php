<?php
/**
 * <kbd>SWL_View_Element_Form</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_View_Element
 * @package     SWL_View_Element_Form
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once 'SWL/View/Element/Container.php';
require_once 'SWL/View/Renderer/Form.php';

/**
 * Form element class
 *
 * @category    SWL_View_Element
 * @package     SWL_View_Element_Form
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_View_Element_Form extends SWL_View_Element_Container {
    
    public function __construct($attributes = array()) {
        if (!isset($attributes['method'])) $attributes['method'] = 'post';
        parent::__construct('form', $attributes);
        $this->setRenderer(new SWL_View_Renderer_Form($this));
    }
    
}