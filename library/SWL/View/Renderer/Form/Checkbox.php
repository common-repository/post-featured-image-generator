<?php
/**
 * <kbd>SWL_View_Renderer_Form_Checkbox</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_View_Renderer_Form
 * @package     SWL_View_Renderer_Form_Checkbox
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once 'SWL/View/Renderer/Form/Element.php';

/**
 * Checkbox field renderer
 *
 * @category    SWL_View_Renderer_Form
 * @package     SWL_View_Renderer_Form_Checkbox
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
class SWL_View_Renderer_Form_Checkbox extends SWL_View_Renderer_Form_Element {
    
    protected $labelPosition = 'after';
    
    public function __construct($element = null, $options = array()) {
        $options['labelPosition'] = 'after';
        parent::__construct($element, $options);
    }
    
    public function renderElement() {
        $html = '';
        $attributes = $this->element->getAttributes();
        $checked = $attributes['checked'];
        if (isset($attributes['label'])) unset($attributes['label']);
        if (isset($attributes['description'])) unset($attributes['description']);
        if (isset($attributes['checked'])) unset($attributes['checked']);
        $html .= '<input'; 
        $html .= ' type="checkbox"'; 
        $html .= ' name="'.esc_attr($this->element->getName()).'"';
        $html .= ' value="'.esc_attr($this->element->getValue()).'"';
        if ($checked) $html .= ' checked="checked"';
        foreach ($attributes as $name => $value) {
            $html .= ' '.$name.'="'.esc_attr($value).'"';
        }
        $html .= ' />';
        return $html;
    }
    
    public function renderLabel() {
        $html = '';
        $attributes = $this->element->getAttributes();
        $label      = isset($attributes['label'])?$attributes['label']:'';
        if ($label!='') {
            $html .= ' '.$label;
        } 
        return $html;
    }    
    
}