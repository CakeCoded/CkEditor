# CKEditor plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require cakecoded/ckeditor
```

Then in config/bootstrap.php add:

```php
Plugin::load('CkEditor');
```

In either src/Controller/AppController.php, or any controller where you want to use CKEditor, add:

```php
public $helpers = ['CkEditor.Ck'];
```

Finally, in your template file, simply add this to call CKEditor:

```php
echo $this->Ck->input('field_name');
```

This is the equilivant of using
```php
echo $this->Form->input('field_name');
```

Except that CKEditor will be loaded instead of a text area!

## Advanced Options

You can make adjustments to CKEditor and the form input as needed.  There is full flexibility in this regard.

The full explaination is as follows:

```php
echo $this->Form->input($input, $options, $ckEditorOptions, $ckEditorUrl);
```
```php
@param string $input
```
The name of the field, can be field_name or model.field_name

```php
@param array $options
```
Options include $options['label'] for a custom label and any other custom Form Helper options

```php
@param array $ckEditorOptions
```
This will pass any options from [http://docs.ckeditor.com/#!/guide/dev_configuration](http://docs.ckeditor.com/#!/guide/dev_configuration) to CKEditor

```php
@param string $ckEditorUrl
```
This gives an option to overwrite the CKEditor URL.  You can use a local URL then if required.

## Examples

Use an associated field name

```php
echo $this->Ck->input('category.description');
```

Generate a custom label

```php
echo $this->Ck->input('field_name', ['label' => 'A unique label']);
```

Add options to CKEditor from [http://docs.ckeditor.com/#!/guide/dev_configuration](http://docs.ckeditor.com/#!/guide/dev_configuration)

```php
echo $this->Ck->input('field_name', [], ['fullPage' => true, 'allowedContent' => 'true']);
```

Load a local version of CKEditor, or a different version

```php
echo $this->Ck->input('field_name', [], [], '/js/ckeditor.js');
```

Example showing all the options together

```php
echo $this->Ck->input('field_name', ['label' => 'A unique label'], ['fullPage' => true, 'allowedContent' => 'true'], '/js/ckeditor.js');
```