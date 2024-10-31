<?php
/**
 * <kbd>SWL_Form_Element_View_Fieldset</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_Form_Element_View
 * @package     SWL_Form_Element_View_Fieldset
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once __DIR__ . '/../../../View/Renderer.php';

/**
 * Textarea renderer
 *
 * @category    SWL_Form_Element_View
 * @package     SWL_Form_Element_View_Fieldset
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_Form_Element_Renderer_Fieldset extends SWL_View_Renderer {
    
    public function html() {
        $html = '';
        $html .= '<fieldset>';
        $html .= '<legend>'.$this->element->getTitle().'</legend>';
        $elements = $this->element->getElements();
        foreach ($elements as $element) {
            $html .= $element->getRenderer()->html();
        }
        $html .= '</fieldset>';
        return $html;
    }
    
}