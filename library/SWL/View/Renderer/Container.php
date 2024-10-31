<?php
/**
 * <kbd>SWL_View_Renderer_Container</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_View_Renderer
 * @package     SWL_View_Renderer_Container
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once 'SWL/View/Renderer.php';

/**
 * Elements container renderer
 *
 * @category    SWL_View_Renderer
 * @package     SWL_View_Renderer_Container
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_View_Renderer_Container extends SWL_View_Renderer {
    
    public function html() {
        $html = '';
        foreach ($this->element->getElements() as $element) {
            $html .= $element->render(false);
        } 
        return $html;
    }
    
}