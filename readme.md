## Laravel Form Validator

Inspired by [Laracasts' Form Validator](https://github.com/laracasts/Validation) this package provides an easy method for validating form data, including
checks for unique values.

 ### Installation
 This package should be installed via composer:

1. Add ```"srlabs/validator": "1.*"``` to your ```composer.json``` file.
2. Run ```composer update```

### Usage

To use the form validator, first create a form class that extends ```SRLabs\Validator\Validation\FormValidator```.  This
class will specify the rules and custom messages you want to use when validating this form.  For example:

```php
<?php namespace Epiphyte\Forms;
use SRLabs\Validator\Validation\FormValidator;

class UpdateProductionForm extends FormValidator {

    protected $rules = array(
        'name' => 'required|alpha|unique:productions',
        'author' => 'required'
    );

    protected $messages = array(
        'name.unique' => 'There is already a production with that name.'
    );
}
```

Next, inject your custom form class into the controller handling your form submission.

```php
<?php

use Epiphyte\Forms\CreateProductionForm;
use Epiphyte\Forms\UpdateProductionForm;

class ProductionController extends \BaseController {

    protected $createProductionForm;
    protected $updateProductionForm;

    /**
     * @param CreateProductionForm $createProductionForm
     */
    public function __construct(CreateProductionForm $createProductionForm, UpdateProductionForm $updateProductionForm)
    {
        $this->createProductionForm = $createProductionForm;
        $this->updateProductionForm = $updateProductionForm;
    }
}
```
