<?php
/**
 * <kbd>SWL_Form_Element_Renderer_Color</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_Form_Element_Renderer
 * @package     SWL_Form_Element_Renderer_Color
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once __DIR__ . '/Renderer.php';

/**
 * Textarea renderer
 *
 * @category    SWL_Form_Element_Renderer
 * @package     SWL_Form_Element_Renderer_Color
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_Form_Element_Renderer_Color extends SWL_Form_Element_Renderer {
    
    public function renderElement() {
        $html = '';
        $name       = $this->element->getName();
        $value      = $this->element->getValue();
        $attributes = $this->element->getAttributes();
        $html .= '<input type="text" name="'.esc_attr($name).'"';            
        foreach ($attributes as $attrName => $attrValue) {
            $html .= ' '.$attrName.'="'.esc_attr($attrValue).'"';
        }
        $html .= ' value="'.esc_attr($value).'" />';
        $html .= '<script type="text/javascript">
            jQuery(document).ready(function($){
                $(\'input[name="'.esc_attr($name).'"]\').wpColorPicker();
            });
        </script>';  
        return $html;
    }
    
}