<?php
namespace App\View\Helper;

use Cake\View\Helper;

class CkHelper extends Helper
{
    public $helpers = ['Html', 'Form'];

    /**
	* Extention of the Form Helper to insert CK Editor for a form input
	*
	* @param string $input The name of the field, can be field_name or Model.field_name
	* @param array $options Options include $options['label'] for a custom label - this can be expanded on if required
	*/
    public function input($input, $options = []) {
        if (!empty($options['div'])) {
            echo __('<div class="%s">', $options['div']);
        }
        echo $this->Html->script('//cdn.ckeditor.com/4.4.5.1/standard/ckeditor.js');

        if (!empty($options['label'])) {
            echo $this->Form->label($input, $options['label']);
        } else {
        	echo $this->Form->label($input);
        }
        if (!empty($options['value'])) {
            $this->request->data[$model][$field] = $options['value'];
        }
        echo $this->Form->error($input);
        echo $this->Form->input($input, array('type' => 'textarea', 'label' => false, 'error' => false, 'required' => false, 'div' => false));
		?>
			<script type="text/javascript">
				CKEDITOR.replace('<?php echo $input; ?>', {
                    'fullPage' : true,
                    'allowedContent' : true
                });
			</script>

			<p>&nbsp;</p>
		<?php
        if (!empty($options['div'])) {
            echo '</div>';
        }
    }
}