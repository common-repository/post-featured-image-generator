<?php
/**
 * <kbd>SWL_View_Renderable</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_View
 * @package     SWL_View_Renderable
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

/**
 * Renderable interface
 *
 * @category    SWL_View
 * @package     SWL_View_Renderable
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
interface SWL_View_Renderable {

    public function render($print = true);
    
}

