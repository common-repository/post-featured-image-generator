<?php

require_once 'SWL/Page/Admin/Settings.php';
require_once 'SWL/View/Element/Form.php';
require_once 'SWL/View/Element/Metabox.php';
require_once 'SWL/View/Element/Form/Text.php';
require_once 'SWL/View/Element/Form/Boolean.php';
require_once 'SWL/View/Element/Form/Select.php';
require_once 'SWL/View/Element/Form/CheckboxMulti.php';
require_once 'SWL/View/Element/Form/Submit.php';
require_once 'SWL/View/Decorator/Tag.php';


class FIG_Page_Admin_Settings extends SWL_Page_Admin_Settings {
    
    public function __construct() {
        parent::__construct('Settings', array('hide_title' => true));
    }       
    
    public function init() {
        parent::init();
        $this->addStyle(array('name' => 'fig-settings-page', 'src' => plugins_url('css/admin/settings.css', FIG_PATH.'/dummy')));
    }
    
    protected function buildForm() {
        parent::buildForm();
        //setup Image metabox
        $imageMetabox = new SWL_View_Element_Metabox('fig_settings_image', 'Image');
        $imageMetabox->addElementsDecorator(new SWL_View_Decorator_Tag('div', array('class' => 'input')));
        $imageMetabox->addElement(new SWL_View_Element_Form_Boolean('fig_image_enabled', array('label' => 'Enabled')));
        $imageMetabox->addElement(new SWL_View_Element_Form_Text('fig_image_min_width', 0, array('label' => 'Min Width', 'description' => '0 - ignore rule')));
        $imageMetabox->addElement(new SWL_View_Element_Form_Text('fig_image_min_height', 0, array('label' => 'Min Height', 'description' => '0 - ignore rule')));
        //setup Videometabox
        $videoMetabox = new SWL_View_Element_Metabox('fig_settings_video', 'Video');
        $videoMetabox->addElementsDecorator(new SWL_View_Decorator_Tag('div', array('class' => 'input')));
        $videoMetabox->addElement(new SWL_View_Element_Form_Boolean('fig_video_enabled', array('label' => 'Enabled')));
        $videoMetabox->addElement(new SWL_View_Element_Form_Text('fig_video_min_width', 0, array('label' => 'Min Width', 'description' => '0 - ignore rule')));
        $videoMetabox->addElement(new SWL_View_Element_Form_Text('fig_video_min_height', 0, array('label' => 'Min Height', 'description' => '0 - ignore rule')));
        //setup Post Types metabox
        $typesMetabox = new SWL_View_Element_Metabox('fig_settings_types', 'Post Types');
        $typesMetabox->addElementsDecorator(new SWL_View_Decorator_Tag('div', array('class' => 'input')));
        $types = get_post_types(array(), 'objects');
        $options = array();
        foreach ($types as $name => $type) {
            if (post_type_supports($name, 'thumbnail')) {
                $options[] = array('value' => $name, 'label' => $type->label);
            }
        }
        $typesMetabox->addElement(new SWL_View_Element_Form_CheckboxMulti('fig_types', array('post'), $options));
        //setup Priority metabox
        $priorityMetabox = new SWL_View_Element_Metabox('fig_settings_priority', 'Priority');
        $priorityMetabox->addElementsDecorator(new SWL_View_Decorator_Tag('div', array('class' => 'input')));
        $options = array(
            'ignore' => 'Ignore',
            'iv' => 'Image/Video',
            'vi' => 'Video/Image'
        );
        $priorityMetabox->addElement(new SWL_View_Element_Form_Select('fig_priority_content', 'ignore', $options, array('label' => 'Element Type')));
        $options = array(
            'ignore' => 'Ignore',
            'max_width' => 'Max Width',
            'max_height' => 'Max Height',
            'min_width' => 'Min Width',
            'min_height' => 'Min Height',            
        );
        $priorityMetabox->addElement(new SWL_View_Element_Form_Select('fig_priority_size', 'ignore', $options, array('label' => 'Size')));        
        $this->form->addElement($imageMetabox);        
        $this->form->addElement($videoMetabox);
        $this->form->addElement($typesMetabox);
        $this->form->addElement($priorityMetabox);
        $this->form->addElement(new SWL_View_Element_Form_Submit('update', 'Update', array('class' => 'button button-primary')));
    }
    
} 
