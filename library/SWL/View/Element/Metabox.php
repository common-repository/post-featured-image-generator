<?php
/**
 * <kbd>SWL_View_Element_Metabox</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_View_Element
 * @package     SWL_View_Element_Metabox
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once 'SWL/View/Element/Container.php';

/**
 * Metabox container class
 *
 * @category    SWL_View_Element
 * @package     SWL_View_Element_Metabox
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_View_Element_Metabox extends SWL_View_Element_Container {
    
    protected $id;
    
    protected $title;
    
    public function __construct($id, $title = 'Metabox', $attributes = array()) {
        parent::__construct('metabox', $attributes);
        $this->id           = $id;
        $this->title        = $title;
        wp_enqueue_script('common');
	wp_enqueue_script('wp-lists');
	wp_enqueue_script('postbox');
    }
    
    public function getMetaboxContent() {
        echo $this->renderer->render();
    }      
    
    public function render($print = true) {
        add_meta_box(  
                    $this->id, 
                    $this->title, 
                    array($this, 'getMetaboxContent') ,
                    $this->id
                ); 
        ob_start();
        do_meta_boxes($this->id, 'advanced', array());
        $output = ob_get_clean();
        if ($print) echo $output;
        else return $output;        
    }
    
}