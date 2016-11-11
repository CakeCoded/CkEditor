# CkEditor plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require cakeCoded/ckeditor
```

Then in config/bootstrap.php add:

```php
Plugin::load('CkEditor');
```

In either src/Controller/AppController.php, or any controller where you want to use CK Editor, add:

```php
public $helpers = ['CkEditor.Ck'];
```

Finally, in your template file, simply add this to call CK Editor:

```php
echo $this->Ck->input('field_name');
```

This is the equilivant of using
```php
echo $this->Form->input('field_name');
```

Except that CK Editor will be loaded instead of a text area!

## Advanced Options

You can make adjustments to CK Editor and the form input as needed.  There is full flexibility in this regard.

The full explaination is as follows:

```php
echo $this->Form->input($input, $options, $ckEditorOptions, $ckEditorUrl);
```

@param string $input The name of the field, can be field_name or Model.field_name

@param array $options Options include $options['label'] for a custom label and any other custom Form Helper options

@param array $ckEditorOptions This will pass any options from [http://docs.ckeditor.com/#!/guide/dev_configuration](http://docs.ckeditor.com/#!/guide/dev_configuration) to CK Editor

@param string $ckEditorUrl This gives an option to overwrite the CK Editor URL.  You can use a local URL then if required.

## Examples

Use an associated field name

```php
echo $this->Ck->input('Categories.content');
```

Generate a custom label

```php
echo $this->Ck->input('field_name', ['label' => 'A unique label']);
```

Add options to CK Editor from [http://docs.ckeditor.com/#!/guide/dev_configuration](http://docs.ckeditor.com/#!/guide/dev_configuration)

```php
echo $this->Ck->input('field_name', null, ['fullPage' => true, 'allowedContent' => 'true']);
```

Load a local version of CK Editor, or a different version

```php
echo $this->Ck->input('field_name', null, null, '//cdn.ckeditor.com/4.5.11/full/ckeditor.js');
```

Example showing all the options together

```php
echo $this->Ck->input('field_name', ['label' => 'A unique label'], ['fullPage' => true, 'allowedContent' => 'true'], '//cdn.ckeditor.com/4.5.11/full/ckeditor.js');
```