<?php
/**
 * <kbd>SWL_View_Renderer_Form_Select</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_View_Renderer_Form
 * @package     SWL_View_Renderer_Form_Select
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once 'SWL/View/Renderer/Form/Element.php';

/**
 * Textarea renderer
 *
 * @category    SWL_View_Renderer_Form
 * @package     SWL_View_Renderer_Form_Select
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_View_Renderer_Form_Select extends SWL_View_Renderer_Form_Element {
    
    public function renderElement() {
        $html = '';
        $attributes = $this->element->getAttributes();
        $checked = $attributes['checked'];
        if (isset($attributes['label'])) unset($attributes['label']);
        if (isset($attributes['description'])) unset($attributes['description']);
        $html .= '<select name="'.esc_attr($this->element->getName()).'"';            
        foreach ($attributes as $name => $value) {
            $html .= ' '.$name.'="'.esc_attr($value).'"';
        }
        $html .= '>';
        foreach ($this->element->getOptions() as $value => $label) {
            $html .= '<option value="'.esc_attr($value).'"'.($value==$this->element->getValue()?' selected="selected"':'').'>'.$label.'</option>';
        }
        $html .= '</select>';
        return $html;
    }
    
}