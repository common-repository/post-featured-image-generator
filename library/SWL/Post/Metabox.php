<?php
/**
 * <kbd>SWL_Post_Metabox</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_Post
 * @package     SWL_Post_Metabox
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

/**
 * Metabox container class
 *
 * @category    SWL_Post
 * @package     SWL_Post_Metabox
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_Post_Metabox {
    
    protected $fields = array();    
    
    protected $id;
    
    protected $title;
    
    protected $type;
    
    protected $showDecor = true;
    
    protected $css = array();
    
    public function __construct($id, $type, $title = 'Metabox', $showDecor = true) {
        $this->id           = $id;
        $this->type         = $type;
        $this->title        = $title;
        $this->showDecor    = $showDecor;
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
        SWL_Action_Manager::getInstance()->addAction(new SWL_Action(array($this, 'save'), 'save_post'), false);
        SWL_Action_Manager::getInstance()->addAction(new SWL_Action(array($this, 'appendStyles'), 'admin_enqueue_scripts'), false);
    }
    
    public function appendStyles() {
        foreach ($this->css as $style) {
            wp_enqueue_style($style['name'], $style['path'], false);
        } 
    }
    
    function save($postId) {  
        //verify nonce  
        if (!wp_verify_nonce($_POST[$this->id.'_meta_box_nonce'], basename(__FILE__)))   
            return $postId;  
        //check autosave  
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)  
            return $postId; 
        //check post type
        if ($this->type != $_POST['post_type'])
            return $postId; 
        foreach ($this->fields as $field) {
            if ($field instanceof SWL_Form_Element) {
                delete_post_meta($postId, $field->getName());
                add_post_meta($postId, $field->getName(), $_POST[$field->getName()], true);
            }
        }
    }    
    
    public function addField(SWL_View_Element $field) {
        $this->fields[] = $field;
    }
    
    public function render() {
        global $post;
        echo '<input type="hidden" name="'.$this->id.'_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
        foreach ($this->fields as $field) {
            if ($field instanceof SWL_Form_Element) {
                if (metadata_exists($this->type, $post->ID, $field->getName()))
                    $field->setValue(get_post_meta($post->ID, $field->getName(), true));
            }
            $field->render();
        }        
    }
    
    public function addCss($style) {
        $this->css[] = $style;
    }
    
}