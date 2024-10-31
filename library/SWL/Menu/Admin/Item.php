<?php
/**
 * <kbd>SWL_Admin_Menu_Item</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_Admin_Menu
 * @package     SWL_Admin_Menu_Item
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

/**
 * Admin menu item class
 *
 * @category    SWL_Admin_Menu
 * @package     SWL_Admin_Menu_Item
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_Admin_Menu_Item {
    
    protected $pageTitle;
    
    protected $menuTitle;
    
    protected $capability;
    
    protected $menuSlug;
    
    protected $parentSlug;
    
    protected $renderer;
    
    protected $iconUrl;
    
    protected $position;
    
    public function __construct($menuTitle, $menuSlug, SWL_Page_Admin $renderer, $parentSlug = '',
                                $pageTitle = '', $capability = 'manage_options', 
                                $iconUrl = '', $position = '') {
        $this->pageTitle    = $pageTitle!=''?$pageTitle:$this->menuTitle;
        $this->menuTitle    = $menuTitle;
        $this->capability   = $capability;
        $this->menuSlug     = $menuSlug;
        $this->parentSlug   = $parentSlug;
        $this->renderer     = $renderer;
        $this->iconUrl      = $iconUrl;
        $this->position     = $position;
    }
    
    public function init() {
        if ($this->parentSlug!='') {
            $suffix = add_submenu_page($this->parentSlug, $this->pageTitle, 
                             $this->menuTitle, $this->capability, 
                             $this->menuSlug, array($this->renderer, 'render'));
        } else {
            $suffix = add_menu_page($this->pageTitle, $this->menuTitle, $this->capability, 
                          $this->menuSlug, array($this->renderer, 'render'), $this->iconUrl, 
                          $this->position);
        }
        add_action('load-'.$suffix , array($this->renderer, 'init'));
    }
    
}

