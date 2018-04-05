<?php
namespace CkEditor\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

class CkHelper extends Helper
{
    public $helpers = ['Html', 'Form'];

    /**
     * Possibility of changing the distro and toolbar layout
     * @param version The version of distro
     * @param distribution The layout of distro i.e.: Basic, Full, Standard 
     */
    protected $_defaultConfig = [
        'version' => '4.9.1',
        'distribution' => 'full'
      ];

    protected $_configs = [];

    /**
     * Construct
     * 
     * @param View $view
     * @param type $config
     */
    public function __construct(View $view, $config = []) {
        parent::__construct($view, $config);
        $this->_configs = $this->config();
    }
    
    
    /**
    * Extention of the Form Helper to insert CKEditor for a form input
    *
    * @param string $input The name of the field, can be field_name or Model.field_name and any other custom Form Helper options
    * @param array $options Options include $options['label'] for a custom label
    * @param array $ckEditorOptions This will pass any options from http://docs.ckeditor.com/#!/guide/dev_configuration to CKEditor
    * @param string $ckEditorUrl This gives an option to overwrite the CKEditor URL.  You can use a local URL then if required.
    */
    public function input($input, $options = [], $ckEditorOptions = [], $ckEditorUrl = null) {
        $lines = [];

        /**
         * Included the config passed before
         */
        if (!$ckEditorUrl) {
             $ckEditorUrl = "//cdn.ckeditor.com/{$this->_configs['version']}/{$this->_configs['distribution']}/ckeditor.js";
        }

        $lines[] = $this->Html->script($ckEditorUrl);

        $defaultOptions = ['type' => 'textarea', 'required' => false];
        $options = array_merge($defaultOptions, $options);

        $lines[] = $this->Form->error($input);
        $lines[] = $this->Form->input($input, $options);
        $lines[] = $this->generateScript($input, $ckEditorOptions);

        return implode($lines, PHP_EOL);
    }

    /**
     * Generates the script for CKEditor
     * @param  string $input The name of the field, can be field_name or Model.field_name
     * @param  array  $options Any passed options, from http://docs.ckeditor.com/#!/guide/dev_configuration
     *         These should be passed as an array, e.g. ['fullPage' => true]
     * @return string
     */
    protected function generateScript($input, $options = []) {
        $script = '<script type="text/javascript">';
        $script .= 'CKEDITOR.replace(\'';
        $script .= $input;
        $script .= "'";

        if ($options) {
            $script .= ', {';

            foreach ($options as $key => $value) {
                $script .= "'$key' : '$value',";
            }

            $script .= '}';
        }

        $script .= ');';
        $script .= '</script>';

        return $script;
    }
}
