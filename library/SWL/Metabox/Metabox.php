<?php
/**
 * <kbd>SWL_Metabox</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL
 * @package     SWL_Metabox
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once 'View/Element.php';

require_once 'Metabox/Renderer/Metabox.php';

/**
 * Metabox container class
 *
 * @category    SWL
 * @package     SWL_Metabox
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_Metabox extends SWL_View_Element {
    
    protected $elements = array();    
    
    protected $id;
    
    protected $title;
    
    protected $type;
    
    public function __construct($id, $type, $title = 'Metabox') {
        parent::__construct('metabox');
        $this->setRenderer(new SWL_Metabox_Renderer_Metabox($this));
        $this->id           = $id;
        $this->type         = $type;
        $this->title        = $title;
        $this->init();
    }
    
    public function init() {
        add_meta_box(  
                    $this->id, 
                    $this->title, 
                    array($this, 'render') ,
                    $this->type,
                    'normal',
                    'high'
                ); 
    }
    
    public function addElement(SWL_View_Element $element) {
        $this->elements[] = $element;
    }
    
    public function getElements() {
        return $this->elements;
    }
    
}