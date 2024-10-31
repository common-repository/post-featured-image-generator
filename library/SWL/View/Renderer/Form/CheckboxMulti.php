<?php
/**
 * <kbd>SWL_View_Renderer_Form_CheckboxMulti</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_View_Renderer_Form
 * @package     SWL_View_Renderer_Form_CheckboxMulti
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once 'SWL/View/Renderer/Form/Element.php';

/**
 * Checkbox field renderer
 *
 * @category    SWL_View_Renderer_Form
 * @package     SWL_View_Renderer_Form_CheckboxMulti
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_View_Renderer_Form_CheckboxMulti extends SWL_View_Renderer_Form_Element {
    
    public function __construct($element = null, $options = array()) {
        parent::__construct($element, $options);
    }
    
    public function renderElement() {
        $html = '';
        $attributes = $this->element->getAttributes();
        foreach ($this->element->getOptions() as $option) {
            $html .= '<div>';
            $html .= '<input type="checkbox"';
            $html .= ' name="'.esc_attr($this->element->getName()).'[';
            if (isset($option['name'])) $html .= esc_attr($option['name']);
            $html .= ']"';
            $html .= ' value="'.esc_attr($option['value']).'"';
            if (in_array($option['value'], $this->element->getValue())) {
               $html .= ' checked="checked"'; 
            }
            $html .= ' />';
            $html .= ' '.$option['label'];
            $html .= '</div>';
        }
        return $html;
    } 
    
}