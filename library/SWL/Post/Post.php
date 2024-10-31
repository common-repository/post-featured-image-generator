<?php
/**
 * <kbd>SWL_Post</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL
 * @package     SWL_Post
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once __DIR__ . '/../Action/Manager.php';

/**
 * Custom post implementation
 *
 * @category    SWL
 * @package     SWL_Post
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_Post {
    
    protected $actionsManager;
    
    protected $type;
    
    protected $supports = array();
    
    protected $labels = array();
    
    protected $boxes = array();
    
    public function __construct($type, $args = array()) {
        $this->actionsManager = SWL_Action_Manager::getInstance();
        $this->type     = $type;
        $this->supports = isset($args['supports'])?$args['supports']:false;
        $this->labels   = isset($args['labels'])?$args['labels']:array();
    }
    
    public function addMetabox($box) {
        $this->boxes[] = $box;
    }
    
    public function registerMetabox() {
        foreach ($this->boxes as $box) $box->init();
    }
    
    public function addAdminAssets() {
        wp_enqueue_style('swl-post-admin-css', plugins_url('/assets/css/admin/post.css', __FILE__), null);
    }    
   
    public function init() {
        register_post_type($this->type,
		array(
			'labels'    => $this->labels,
                        'supports'  => $this->supports,
                        'public'    => true,
                    )
	); 
        if (count($this->boxes)) {
            $this->actionsManager->addAction(new SWL_Action(array($this, 'registerMetabox'), 'add_meta_boxes'), false);
            //
            //$this->actionsManager->addAction(new SWL_Action(array($this, 'addAdminAssets'), 'admin_enqueue_scripts'), false);
        }    
    }
    
}