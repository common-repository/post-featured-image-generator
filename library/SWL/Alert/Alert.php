<?php
/**
 * <kbd>SWL_Alert</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL
 * @package     SWL_Alert
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once __DIR__ . '/../View/Element.php';
require_once __DIR__ . '/Renderer/Alert.php';

/**
 * Alert base class
 *
 * @category    SWL
 * @package     SWL_Alert
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_Alert extends SWL_View_Element {
    
    protected $text = '';
    
    public function __construct($type, $text, $attributes = array()) {    
        parent::__construct($type, $attributes);
        $this->text = $text;
        $this->setRenderer(new SWL_Alert_Renderer_Alert($this));
    }
    
    public function getText() {
        return $this->text;
    }
    
    public function getType() {
        return $this->type;
    }    
    
    public function __sleep() {
        return array('type', 'text', 'attributes');
    }
    
    public function __wakeup() {
        $this->setRenderer(new SWL_Alert_Renderer_Alert($this));
    }
    
}