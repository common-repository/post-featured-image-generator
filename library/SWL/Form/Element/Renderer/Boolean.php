<?php
/**
 * <kbd>SWL_Form_Element_Renderer_Boolean</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_Form_Element_Renderer
 * @package     SWL_Form_Element_Renderer_Boolean
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once __DIR__ . '/Renderer.php';

/**
 * Boolean field renderer
 *
 * @category    SWL_Form_Element_Renderer
 * @package     SWL_Form_Element_Renderer_Boolean
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_Form_Element_Renderer_Boolean extends SWL_Form_Element_Renderer {
    
    protected $labelPosition = 'after';
    
    public function renderElement() {
        $html = '';
        $name       = $this->element->getName();
        $value      = $this->element->getValue();
        $attributes = $this->element->getAttributes();
        $html .= '<input type="hidden" name="'.esc_attr($name).'" value="0" />';
        $html .= '<input type="checkbox" name="'.esc_attr($name).'"';            
        foreach ($attributes as $attrName => $attrValue) {
            $html .= ' '.$attrName.'="'.esc_attr($attrValue).'"';
        }
        $html .= ' value="1'.esc_attr($value).'"';
        if ($this->element->isChecked()) {
            $html .= 'checked="checked"';
        }
        $html .= ' />';
        return $html;
    }
    
    public function renderLabel() {
        $html = '';
        $label      = $this->element->getLabel();
        if ($label!='') {
            $html .= ' '.$label;
        } 
        return $html;
    }    
    
}