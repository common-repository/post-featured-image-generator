<?php
/**
 * <kbd>SWL_Form_Element_Renderer</kbd> class file
 *
 * PHP version 5
 *
 * @category    SWL_Form_Element
 * @package     SWL_Form_Element_Renderer
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once __DIR__ .'/../../../View/Renderer.php';

/**
 * Form element renderer
 *
 * @category    SWL_Form_Element
 * @package     SWL_Form_Element_Renderer
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     0.0.1
 */
abstract class SWL_Form_Element_Renderer extends SWL_View_Renderer  {
    
    protected $renderLabel = true;
    
    protected $renderDescription = true;
    
    protected $labelPosition = 'before';
    
    public function __construct($element, $options = array()) {    
        parent::__construct($element);
        if (isset($options['renderLabel'])) $this->renderLabel = $options['renderLabel'];
        if (isset($options['renderDescription'])) $this->renderDescription = $options['renderDescription'];
        if (isset($options['labelPosition'])) $this->labelPosition = $options['labelPosition'];
    }
    
    public function html() {
        $html = '';
        if ($this->renderLabel && $this->labelPosition == 'before') $html .= $this->renderLabel();
        $html .= $this->renderElement();
        if ($this->renderLabel && $this->labelPosition == 'after') $html .= $this->renderLabel();
        if ($this->renderDescription) $html .= $this->renderDescription();
        $html = $this->decorate($html);
        return $html;
    }
    
    protected function decorate($html) {
        foreach ($this->element->getDecorators() as $decorator) {
            $html = $decorator->decorate($html);
        }
        return $html;
    }
    
    public function renderLabel() {
        $html = '';
        $label      = $this->element->getLabel();
        $attributes = $this->element->getAttributes();
        $id         = isset($attributes['id'])?$attributes['id']:'';
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
            $html .= '<div class="description">'.$description.'</div>';
        }    
        return $html;    
    }
    
    abstract function renderElement();
    
}