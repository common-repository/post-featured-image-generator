<?php
/**
 * <kbd>SWL_Form_Element_Renderer_Submit</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_Form_Element_Renderer
 * @package     SWL_Form_Element_Renderer_Submit
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once __DIR__ . '/Renderer.php';

/**
 * Submit renderer
 *
 * @category    SWL_Form_Element_Renderer
 * @package     SWL_Form_Element_Renderer_Submit
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_Form_Element_Renderer_Submit extends SWL_Form_Element_Renderer {
    
    public function renderElement() {
        $html = '';
        $name       = $this->element->getName();
        $label      = $this->element->getlabel();
        $attributes = $this->element->getAttributes();
        $html .= '<input type="submit"'; 
        foreach ($attributes as $attrName => $attrValue) {
            $html .= ' '.$attrName.'="'.esc_attr($attrValue).'"';
        }
        $html .= ' value="'.esc_attr($label).'" />';
        return $html;
    }
    
}