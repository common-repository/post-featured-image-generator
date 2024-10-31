<?php
/**
 * <kbd>SWL_Form_Element_Renderer_Select</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_Form_Element_Renderer
 * @package     SWL_Form_Element_Renderer_Select
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once __DIR__ . '/Renderer.php';

/**
 * Textarea renderer
 *
 * @category    SWL_Form_Element_Renderer
 * @package     SWL_Form_Element_Renderer_Select
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_Form_Element_Renderer_Select extends SWL_Form_Element_Renderer {
    
    public function renderElement() {
        $html = '';
        $name       = $this->element->getName();
        $value      = $this->element->getValue();
        $options    = $this->element->getOptions();
        $attributes = $this->element->getAttributes();
        $html .= '<select name="'.esc_attr($name).'"';            
        foreach ($attributes as $attrName => $attrValue) {
            $html .= ' '.$attrName.'="'.esc_attr($attrValue).'"';
        }
        $html .= '>';
        foreach ($options as $optionValue => $label) {
            $html .= '<option value="'.esc_attr($optionValue).'"'.($optionValue==$value?' selected="selected"':'').'>'.$label.'</option>';
        }
        $html .= '</select>';
        return $html;
    }
    
}