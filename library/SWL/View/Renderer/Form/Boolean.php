<?php
/**
 * <kbd>SWL_View_Renderer_Form_Boolean</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_View_Renderer_Form
 * @package     SWL_View_Renderer_Form_Boolean
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once 'SWL/View/Renderer/Form/Checkbox.php';

/**
 * Boolean field renderer
 *
 * @category    SWL_View_Renderer_Form
 * @package     SWL_View_Renderer_Form_Boolean
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_View_Renderer_Form_Boolean extends SWL_View_Renderer_Form_Checkbox {
    
    public function renderElement() {
        $html = '';
        $html .= '<input type="hidden" name="'.esc_attr($this->element->getName()).'" value="0" />';
        $html .= parent::renderElement();
        return $html;
    }
    
}