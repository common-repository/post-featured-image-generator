<?php
/**
 * <kbd>SWL_Menu_Admin</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_Menu
 * @package     SWL_Menu_Admin
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once __DIR__ . '/Item.php';

/**
 * Admin menu container class
 *
 * @category    SWL_Menu
 * @package     SWL_Menu_Admin
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_Menu_Admin {
    
    protected $items = array();    
    
    public function __construct($menu = array()) {
        $this->buildFromArray($menu);
    }
    
    public function addItem($item) {
        $this->items[] = $item;
    }
    
    public function init() {
        foreach ($this->items as $item) {
            $item->init();
        }
    }
    
    protected function buildFromArray($menu, $parent = '') {
        foreach ($menu as $data) {
            $title = $data['title'];
            $slug = $data['slug'];
            $renderer = $data['renderer'];
            $parent = isset($data['parent'])?$data['parent']:$parent;
            $item = new SWL_Admin_Menu_Item($title, $slug, $renderer, $parent);
            $this->addItem($item);
            if (isset($data['submenu'])) $this->buildFromArray($data['submenu'], $slug);
        }
    }
    
}