<?php
/**
 * <kbd>SWL_View_Renderer_Form</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_View_Renderer
 * @package     SWL_View_Renderer_Form
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once 'SWL/View/Renderer/Container.php';

/**
 * Form renderer
 *
 * @category    SWL_View_Renderer
 * @package     SWL_View_Renderer_Form
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_View_Renderer_Form extends SWL_View_Renderer_Container {
    
    public function html() {
        $html = '';
        $html .= '<form';
        foreach ($this->element->getAttributes() as $name => $value) {
            $html .= ' '.$name.'="'.esc_attr($value).'"';
        }    
        $html .= '>'; 
        foreach ($this->element->getElements() as $element) {
            $html .= $element->render(false);
        }
        $html .= '</form>';
        return $html;
    }
    
}