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