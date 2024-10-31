<?php
/**
 * <kbd>SWL_Form_Element_Container</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_Form_Element
 * @package     SWL_Form_Element_Container
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once 'View/Element.php';

/**
 * Form elements container
 *
 * @category    SWL_Form_Element
 * @package     SWL_Form_Element_Container
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_Form_Element_Container extends SWL_View_Element {
    
    protected $elements   = array();
    
    protected $title = '';
    
    public function __construct($type, $title = '', $attributes = array()) {    
        $this->title = $title;
        parent::__construct($type, $attributes);
    }
    
    public function addElement(SWL_View_Element $element) {
        $this->elements[] = $element;
    }
    
    public function getElements() {
        return $this->elements;
    } 
    
    public function getTitle() {
        return $this->title;
    }
    
    
}