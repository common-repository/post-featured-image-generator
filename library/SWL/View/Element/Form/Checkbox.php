<?php
/**
 * <kbd>SWL_View_Element_Form_Checkbox</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_View_Element_Form
 * @package     SWL_View_Element_Form_Checkbox
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once 'SWL/View/Element/Form/Element.php';
require_once 'SWL/View/Renderer/Form/Checkbox.php';

/**
 * Checkbox element
 *
 * @category    SWL_View_Element_Form
 * @package     SWL_View_Element_Form_Checkbox
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_View_Element_Form_Checkbox extends SWL_View_Element_Form_Element {
    
    public function __construct($name, $value, $attributes = array(), $options = array()) {    
        if (isset($attributes['checked'])) $attributes['checked'] = true;
        parent::__construct('checkbox', $name, $value, $attributes, $options);
        $this->setRenderer(new SWL_View_Renderer_Form_Checkbox($this));
    }
    
    public function isChecked() {
        return $this->attributes['checked'];
    }
    
    public function checked($flag) {
        $this->attributes['checked'] = $flag;
    }
    
    public function setValue($value) {
        if ($this->value==$value) $this->checked(true);
        else $this->checked(false);
    }
    
}

