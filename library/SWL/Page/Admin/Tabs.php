<?php
/**
 * <kbd>SWL_Page_Admin_Tabs</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_Page_Admin
 * @package     SWL_Page_Admin_Tabs
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once __DIR__ . '/Page.php';

/**
 * Page with tabs class
 *
 * @category    SWL_Page_Admin
 * @package     SWL_Page_Admin_Tabs
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_Page_Admin_Tabs extends SWL_Page_Admin {
    
    protected $tabs = array();    
    
    protected $page;
    
    protected $currentTab;
    
    public function __construct($title = '', $page = '', $defaultTab = '', $options = array()) {
        parent::__construct($title, $options);
        $this->page = $page;
        $this->currentTab = isset($_GET['tab'])?$_GET['tab']:$defaultTab;
    }
    
    public function addTab(SWL_Page_Admin $page, $tabName) {
        $this->tabs[$tabName] = $page;
    }
    
    public function init() {
        parent::init();
        $this->tabs[$this->currentTab]->init();
    }
    
    public function render($print = true) {
    ?>    
        <div class="wrap swl-page swl-tabs-page">
            <?php screen_icon(); ?>
            <h2><?php echo $this->title; ?></h2>
            <?php if (count($this->sidebarElements)): ?><div class="left-section"><?php endif; ?>
                <h2 class="nav-tab-wrapper"> 
                    <?php foreach ($this->tabs as $tabName => $tab): ?>
                        <a href="?page=<?php echo $this->page; ?>&tab=<?php echo $tabName; ?>" class="nav-tab<?php echo $this->currentTab==$tabName?' nav-tab-active':''; ?>"><?php echo $tab->getTitle(); ?></a>  
                    <?php endforeach; ?>
                </h2> 
                <?php if (isset($this->tabs[$this->currentTab])): ?>
                    <?php $this->tabs[$this->currentTab]->render(); ?>
                <?php endif; ?>
            <?php if (count($this->sidebarElements)): ?>
            </div>
            <div class="right-section">
                <?php 
                foreach ($this->sidebarElements as $element) {
                    $element->render();
                }
                ?>
            </div> 
            <?php endif; ?>
        </div>
    <?php     
    }  
    
}