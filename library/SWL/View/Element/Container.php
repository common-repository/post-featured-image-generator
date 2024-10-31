<?php
/**
 * <kbd>SWL_View_Element_Container</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_View_Element
 * @package     SWL_View_Element_Container
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once 'SWL/View/Element.php';

/**
 * Elements container
 *
 * @category    SWL_View_Element
 * @package     SWL_View_Element_Container
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_View_Element_Container extends SWL_View_Element {
    
    protected $elements   = array();
    
    protected $elementDecorators = array();    
    
    public function __construct($type = 'container', $attributes = array()) {    
        parent::__construct($type, $attributes);
        $this->setRenderer(new SWL_View_Renderer_Container($this));
    }
    
    public function addElement(SWL_View_Element $element) {
        foreach ($this->elementDecorators as $decorator) {
            $element->addDecorator($decorator);
        }
        $this->elements[] = $element;
    }
    
    public function addElementsDecorator(SWL_View_Decorator $decorator) {
        $this->elementDecorators[] = $decorator;
    }    
    
    public function getElements() {
        return $this->elements;
    }
    
}