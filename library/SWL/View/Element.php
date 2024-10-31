<?php
/**
 * <kbd>SWL_View_Element</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_View
 * @package     SWL_View_Element
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once __DIR__ . '/../View/Renderable.php';

/**
 * Html element base class
 *
 * @category    SWL_View
 * @package     SWL_View_Element
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_View_Element implements SWL_View_Renderable {
    
    protected $type;    
   
    protected $attributes   = array();
    
    protected $decorators   = array();
    
    protected $renderer;  
    
    public function __construct($type, $attributes = array()) {    
        $this->type         = $type;
        $this->attributes   = array_merge($this->attributes, $attributes);
    }
    
    public function getAttributes() {
        return $this->attributes;
    }
    
    public function getDecorators() {
        return $this->decorators;
    }
    
    public function addDecorator(SWL_View_Decorator $decorator) {
        $this->decorators[] = $decorator;
    }
    
    public function getRenderer() {
        return $this->renderer;
    }
    
    public function setRenderer(SWL_View_Renderer $renderer) {
        $this->renderer = $renderer;
    }
    
    public function render($print = true) {
        $output = $this->renderer->render();
        if ($print) echo $output;
        else return $output;
    }  
    
    public function getType() {
        return $this->type;
    } 
    
}