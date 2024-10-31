<?php
/**
 * <kbd>SWL_Form</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL
 * @package     SWL_Form
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once 'View/Element.php';
require_once 'Form/Renderer/Form.php';

/**
 * Base form class
 *
 * @category    SWL
 * @package     SWL_Form
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_Form extends SWL_View_Element {
    
    protected $elements = array(); 
    
    protected $decorators = array();
    
    protected $elementDecorators = array();
    
    public function __construct($attributes = array(), $options = array()) {
        if (!isset($attributes['method'])) $attributes['method'] = 'post';
        parent::__construct('form', $attributes);
        $this->setRenderer(new SWL_Form_Renderer_Form($this, isset($options['renderer'])?$options['renderer']:array()));
    }
    
    public function addElement(SWL_View_Element $element) {
        foreach ($this->elementDecorators as $decorator) {
            $element->addDecorator($decorator);
        }
        $this->elements[] = $element;
    }
    
    public function addDecorator(SWL_View_Decorator $decorator) {
        $this->decorators[] = $decorator;
    }
    
    public function addElementsDecorator(SWL_View_Decorator $decorator) {
        $this->elementDecorators[] = $decorator;
    }
    
    public function getElements() {
        return $this->elements;
    }  
    
}

