<?php
/**
 * <kbd>SWL_Form_Element_Renderer</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_Form_Element
 * @package     SWL_Form_Element_Renderer
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

/**
 * Form element renderer
 *
 * @category    SWL_Form_Element
 * @package     SWL_Form_Element_Renderer
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
abstract class SWL_View_Renderer  {
    
    protected $element;
    
    public function __construct($element = null) {
        if (!is_null($element)) $this->setElement($element);
    }
    
    public function setElement(SWL_View_Renderable $element) {
        $this->element = $element;
    }
    
    public function render() {
        return $this->decorate($this->html());
    }
    
    protected function decorate($html) {
        foreach ($this->element->getDecorators() as $decorator) {
            $html = $decorator->decorate($html);
        }
        return $html;
    }    
    
    abstract public function html();
    
}