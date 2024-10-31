<?php
/**
 * <kbd>SWL_Form_Element_Renderer_Radiochoice</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_Form_Element_Renderer
 * @package     SWL_Form_Element_Renderer_Radiochoice
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once __DIR__ . '/Renderer.php';

/**
 * Radiochoice field renderer
 *
 * @category    SWL_Form_Element_Renderer
 * @package     SWL_Form_Element_Renderer_Radiochoice
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_Form_Element_Renderer_Radiochoice extends SWL_Form_Element_Renderer {
    
    public function renderElement() {
        $html = '';
        $elements  = $this->element->getElements();
        foreach ($elements as $element) {
            $html .= $element->getRenderer()->html();
        }
        return $html;
    }
    
    public function renderLabel() {
        $html = '';
        $label      = $this->element->getLabel();
        if ($label!='') {
            $html .= '<h3>'.$label.'</h3>';
        } 
        return $html;
    }    
    
}