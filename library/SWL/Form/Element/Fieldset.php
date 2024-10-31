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

require_once 'Form/Element/Container.php';
require_once __DIR__ .'/Renderer/Fieldset.php';

/**
 * Form element
 *
 * @category    SWL_Form
 * @package     SWL_Form_Element
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_Form_Element_Fieldset extends SWL_Form_Element_Container {
    
    public function __construct($title = '', $attributes = array(), $options = array()) {    
        parent::__construct('fieldset', $title, $attributes);
        $this->setRenderer(new SWL_Form_Element_Renderer_Fieldset($this, isset($options['renderer'])?$options['renderer']:array()));
    }
    
}