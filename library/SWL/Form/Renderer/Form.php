<?php
/**
 * <kbd>SWL_Form_Renderer_Form</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_Form_Renderer
 * @package     SWL_Form_Renderer_Form
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once __DIR__ . '/../../View/Renderer.php';

/**
 * Form renderer
 *
 * @category    SWL_Form_Renderer
 * @package     SWL_Form_Renderer_Form
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_Form_Renderer_Form extends SWL_View_Renderer {
    
    public function html() {
        $attributes = $this->element->getAttributes();
        $html = '';
        $html .= '<form';
        foreach ($attributes as $attrName => $attrValue) {
            $html .= ' '.$attrName.'="'.esc_attr($attrValue).'"';
        }    
        $html .= '>'; 
        $elements = $this->element->getElements();
        foreach ($elements as $element) {
            $html .= $element->getRenderer()->html();
        }
        $html .= '</form>';
        return $html;
    }
    
}