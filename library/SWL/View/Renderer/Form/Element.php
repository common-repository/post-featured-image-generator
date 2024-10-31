<?php
/**
 * <kbd>SWL_View_Renderer_Form_Element</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_View_Renderer_Form
 * @package     SWL_View_Renderer_Form_Element
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once 'SWL/View/Renderer.php';

/**
 * Default form element renderer
 *
 * @category    SWL_View_Renderer_Form
 * @package     SWL_View_Renderer_Form_Element
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_View_Renderer_Form_Element extends SWL_View_Renderer  {
    
    protected $options = array(
        'renderLabel' => true,
        'renderDescription' => true,
        'labelPosition' => 'before'
    );
    
    public function __construct($element = null, $options = array()) {    
        parent::__construct($element);
        $this->options = array_merge($this->options, $options);
    }
    
    public function html() {
        $html = '';
        if ($this->options['renderLabel'] && $this->options['labelPosition'] == 'before') 
            $html .= $this->renderLabel();
        $html .= $this->renderElement();
        if ($this->options['renderLabel'] && $this->options['labelPosition'] == 'after') 
            $html .= $this->renderLabel();
        if ($this->options['renderDescription']) 
            $html .= $this->renderDescription();
        return $html;
    }
    
    public function renderLabel() {
        $html       = '';
        $attributes = $this->element->getAttributes();
        $id         = isset($attributes['id'])?$attributes['id']:'';
        $label      = isset($attributes['label'])?$attributes['label']:'';
        if ($label!='') {
            $html .= '<label'.($id!=''?' for="'.esc_attr($id).'"':'').'>'.$label.'</label>';
        } 
        return $html;
    }
    
    public function renderDescription() {
        $html = '';
        $attributes = $this->element->getAttributes();
        $description = isset($attributes['description'])?$attributes['description']:'';
        if ($description!='') {
            $html .= '<p class="description">'.$description.'</p>';
        }    
        return $html;    
    }
    
    function renderElement() {
        $html = '';
        $attributes = $this->element->getAttributes();
        if (isset($attributes['label'])) unset($attributes['label']);
        if (isset($attributes['description'])) unset($attributes['description']);
        $html .= '<input'; 
        $html .= ' type="'.esc_attr($this->element->getType()).'"'; 
        $html .= ' name="'.esc_attr($this->element->getName()).'"';
        $html .= ' value="'.esc_attr($this->element->getValue()).'"';
        foreach ($attributes as $name => $value) {
            $html .= ' '.$name.'="'.esc_attr($value).'"';
        }
        $html .= ' />';
        return $html;
    }
    
}