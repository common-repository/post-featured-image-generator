<?php
/**
 * <kbd>SWL_Metabox_Renderer_Metabox</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_Metabox_Renderer
 * @package     SWL_Metabox_Renderer_Metabox
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once __DIR__ . '/../../View/Renderer.php';

/**
 * Metabox renderer
 *
 * @category    SWL_Metabox_Renderer
 * @package     SWL_Metabox_Renderer_Metabox
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_Metabox_Renderer_Metabox extends SWL_View_Renderer {
    
    public function html() {
        $html = '';
        foreach ($this->element->getElements() as $element) {
            $html .= $element->getRender()->html();
        } 
        return $html;
    }
    
}