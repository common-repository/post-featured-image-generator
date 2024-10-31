<?php

require_once 'SWL/Page/Admin/Tabs.php';
require_once 'SWL/View/Element/Metabox.php';


class FIG_Page_Admin_Tabs extends SWL_Page_Admin_Tabs {
    
    public function __construct() {
        parent::__construct('Featured Image Generator', 'fig', 'settings');
    }       
    
    public function init() {
        parent::init();
        //$this->addSidebarElement(new SWL_View_Element_Metabox('fig_info', 'Info'));
    }
    
} 