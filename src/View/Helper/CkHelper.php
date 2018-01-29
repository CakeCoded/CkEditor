<?php
namespace CkEditor\View\Helper;

use Cake\View\Helper;

class CkHelper extends Helper
{
    public $helpers = ['Html', 'Form'];

    /**
    * Extention of the Form Helper to insert CKEditor for a form input
    *
    * @param string $input The name of the field, can be field_name or Model.field_name and any other custom Form Helper options
    * @param array $options Options include $options['label'] for a custom label
    * @param array $ckEditorOptions This will pass any options from http://docs.ckeditor.com/#!/guide/dev_configuration to CKEditor
    * @param string $ckEditorUrl This gives an option to overwrite the CKEditor URL.  You can use a local URL then if required.
    * @param  array $ckEditorPlugins An array of locally installed CKEditor plugins to load.
    *         These should be passed as an array per plugin, in the format specified by
    *         {@see https://docs.ckeditor.com/ckeditor4/latest/api/CKEDITOR_plugins.html#addExternal CKEditor documentation},
    *         i.e. $plugins = [['sample', '/myplugins/sample/', 'my_plugin.js']]
    */
    public function input($input, $options = [], $ckEditorOptions = [], $ckEditorUrl = null, $ckEditorPlugins = []) {
        $lines = [];

        if (!$ckEditorUrl) {
            $ckEditorUrl = '//cdn.ckeditor.com/4.6.1/standard/ckeditor.js';
        }

        $lines[] = $this->Html->script($ckEditorUrl);

        $defaultOptions = ['type' => 'textarea', 'required' => false];

        $options = array_merge($defaultOptions, $options);

        $lines[] = $this->Form->error($input);
        $lines[] = $this->Form->input($input, $options);

        $lines[] = $this->generateScript($input, $ckEditorOptions, $ckEditorPlugins);

        return implode($lines, PHP_EOL);
    }

    /**
     * Generates the script for CKEditor
     * @param  string $input The name of the field, can be field_name or Model.field_name
     * @param  array  $options Any passed options, from http://docs.ckeditor.com/#!/guide/dev_configuration
     *         These should be passed as an array, e.g. ['fullPage' => true]
     * @param  array $plugins An array of locally installed CKEditor plugins to load.
     *         These should be passed as an array per plugin, in the format specified by
     *         {@see https://docs.ckeditor.com/ckeditor4/latest/api/CKEDITOR_plugins.html#addExternal CKEditor documentation},
     *         i.e. $plugins = [['sample', '/myplugins/sample/', 'my_plugin.js']]
     * @return string
     */
    protected function generateScript($input, $options = [], $plugins = []) {
        $script = '<script type="text/javascript">';

        if (is_array($plugins) && !empty($plugins)) {

          if (!key_exists('extraPlugins', $options)) {
            $options['extraPlugins'] = '';
          }

          foreach ($plugins as $plugin_data) {

            $extraPlugins = explode(',', $options['extraPlugins']);

            $pluginIsAlreadyLoaded = FALSE;
            foreach ($extraPlugins as $extraPlugin) {
              if ($extraPlugin == $plugin_data[0]) {
                $pluginIsAlreadyLoaded = TRUE;
                break;
              }
            }

            if (!$pluginIsAlreadyLoaded) {
              if (strlen($options['extraPlugins']) != 0) {
                $options['extraPlugins'] .= ',';
              }
              $options['extraPlugins'] .= $plugin_data[0];
            }

            $script .= 'CKEDITOR.plugins.addExternal(\'';
            $script .= $plugin_data[0];
            $script .= '\', \'';
            $script .= $plugin_data[1];
            $script .= '\', \'';

            if (key_exists(2, $plugin_data)) {
              $script .= $plugin_data[2];
            }

            $script .= '\');';
          }
        }

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
