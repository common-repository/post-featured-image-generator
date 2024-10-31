<?php
/**
 * <kbd>SWL_Alert_Renderer_Alert</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_Alert_Renderer
 * @package     SWL_Alert_Renderer_Alert
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once __DIR__ . '/../../View/Renderer.php';

/**
 * Alert renderer
 *
 * @category    SWL_Alert_Renderer
 * @package     SWL_Alert_Renderer_Alert
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_Alert_Renderer_Alert extends SWL_View_Renderer {
    
    public function html() {
        $attributes = $this->element->getAttributes();
        $text = $this->element->getText();
        $type = $this->element->getType();
        $class = 'swl-alert swl-alert-'.$type.' '.$type;
        if (isset($attributes['class'])) $class = ' '.$class;
        $attributes['class'] = $class;     
        $html = '';
        $html .= '<div';
        foreach ($attributes as $attrName => $attrValue) {
            $html .= ' '.$attrName.'="'.esc_attr($attrValue).'"';
        }    
        $html .= '><p>'.$text.'</p></div>';
        return $html;
    }
    
}