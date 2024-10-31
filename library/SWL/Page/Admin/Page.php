<?php
/**
 * <kbd>SWL_Page_Admin</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_Page
 * @package     SWL_Page_Admin
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once __DIR__ .'/../../View/Renderable.php';
require_once __DIR__ . '/../../Action/Action.php';

/**
 * Plugin admin page class
 *
 * @category    SWL_Page
 * @package     SWL_Page_Admin
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
abstract class SWL_Page_Admin implements SWL_View_Renderable {
    
    protected $title;
    
    protected $options = array();
    
    protected $cssFiles = array();
    
    protected $jsFiles = array();
    
    protected $sidebarElements = array();
    
    public function __construct($title = '', $options = array()) {
        $this->title = $title;
        $this->options = array_merge($this->options, $options);
    }

    public function getTitle() {
        return $this->title;
    }
    
    public function addStyle($data) {
        $this->cssFiles[] = $data;
    } 
    
    public function addScript($data) {
        $this->jsFiles[] = $data;
    }   
    
    public function addAssets() {
        foreach ($this->cssFiles as $file) {
            wp_enqueue_style($file['name'], $file['src'], isset($file['deps'])?$file['deps']:array(), isset($file['ver'])?$file['ver']:array());
        }
        foreach ($this->jsFiles as $file) {
            wp_enqueue_script($file['name'], isset($file['src'])?$file['src']:false, isset($file['deps'])?$file['deps']:array(), isset($file['ver'])?$file['ver']:array());
        }        
    }
    
    public function addSidebarElement(SWL_View_Element $element) {
        $this->sidebarElements[] = $element;
    }
    
    public function init() {
        SWL_Action_Manager::getInstance()->addAction(new SWL_Action(array($this, 'addAssets'), 'admin_enqueue_scripts'));
        $this->addStyle(array('name' => 'swl-page-page', 'src' => plugins_url('assets/css/admin/page/page.css', SWL_PATH.'/SWL/dummy')));
    }
    
}