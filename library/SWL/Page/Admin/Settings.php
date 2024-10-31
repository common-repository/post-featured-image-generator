<?php
/**
 * <kbd>SWL_Page_Admin_Settings</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_Page_Admin
 * @package     SWL_Page_Admin_Settings
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once 'SWL/Page/Admin/Page.php';
require_once 'SWL/Alert/Manager.php';
require_once 'SWL/Alert/Alert.php';

/**
 * Settings page class
 *
 * @category    SWL_Page_Admin
 * @package     SWL_Page_Admin_Settings
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
abstract class SWL_Page_Admin_Settings extends SWL_Page_Admin {
    
    protected $form;
    
    protected $options = array(
                                    'register_settings' => true,
                                    'autofill_form'     => true,
                                    'hide_title'        => false
                              );
    
    public function __construct($title = '', $options = array()) {
        parent::__construct($title, $options);
    }   
    
    public function init() {
        parent::init();
        $this->addStyle(array('name' => 'swl-settings-page', 'src' => plugins_url('assets/css/admin/page/settings.css', SWL_PATH.'/SWL/dummy')));
        $this->buildForm();        
        $this->registerSettings();
        $this->processForm();       
        $this->setFormValues();        
    }
    
    protected function registerSettings() {
        if ($this->options['register_settings']) {
            foreach ($this->form->getElements() as $element) {
                $this->registerSetting($element);  
            }
        }        
    }
    
    protected function registerSetting(SWL_View_Element $element) {
        if ($element instanceof SWL_View_Element_Form_Element) {
            $name = $element->getName();
            $defValue = $element->getValue();
            if ($name!='' && get_option($name)===false) {
                add_option($name, $defValue);
            }
        }
        if ($element instanceof SWL_View_Element_Container) {
            foreach ($element->getElements() as $containerElement) {
                $this->registerSetting($containerElement);
            }
        }
    }
    
    protected function processForm() {
        if ($this->isPageFormSubmit()) {
            foreach ($this->form->getElements() as $element) {
                $this->updateSetting($element);
            }
            SWL_Alert_Manager::getInstance()->addAlert(new SWL_Alert('updated', 'Data has been updated'));
        }         
    }
    
    protected function updateSetting(SWL_View_Element $element) {
       if ($element instanceof SWL_View_Element_Form_Element) {
            $name = $element->getName();
            if ($name!='') {
                update_option($name, $_POST[$name]);
            }
        }
        if ($element instanceof SWL_View_Element_Container) {
            foreach ($element->getElements() as $containerElement) {
                $this->updateSetting($containerElement);
            }
        }          
    }
    
    protected function isPageFormSubmit() {
        return ($_SERVER['REQUEST_METHOD'] == 'POST');
    }
    
    protected function setFormValues() {
        if ($this->options['autofill_form']) {            
            foreach ($this->form->getElements() as $element) {
                $this->setFormElementValue($element);  
            }
        }        
    }
    
    protected function setFormElementValue(SWL_View_Element $element) {
        if ($element instanceof SWL_View_Element_Form_Element) {
            $name = $element->getName();
            if ($name!='') {
                $element->setValue(get_option($name));
            }
        }
        if ($element instanceof SWL_View_Element_Container) {
            foreach ($element->getElements() as $containerElement) {
                $this->setFormElementValue($containerElement);
            }
        }        
    }
    
    public function render($print = true) {
    ?>    
        <div class="wrap swl-page swl-settings-page">
        <?php if (!isset($this->options['hide_title'])): ?>
            <?php screen_icon(); ?>
            <h2><?php echo $this->title; ?></h2>
        <?php endif; ?>  
        <?php SWL_Alert_Manager::getInstance()->display(); ?>    
        <?php $this->form->render(); ?>
        </div>
    <?php     
    }  
    
    protected function buildForm() {
        $this->form = new SWL_View_Element_Form();
    }
    
}