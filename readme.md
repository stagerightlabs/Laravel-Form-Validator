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
    public function __construct(
        CreateProductionForm $createProductionForm,
        UpdateProductionForm $updateProductionForm)
    {
        $this->createProductionForm = $createProductionForm;
        $this->updateProductionForm = $updateProductionForm;
    }

    // ...
}
```

To validate form data, do this in your controller method:

```php
public function store()
{
    // Gather the Data
    $data = Input::only('name', 'author');

    // Validate the Form
    $this->createProductionForm->validate($data);

    // Create the Production
    Epiphyte\Production::create($data);

    Session::flash('success', 'Production Added');
    return Redirect::action('ProductionController@index');
}
```

Note that if the validation fails, an exception will be thrown (and subsequently caught) forcing a redirect back to the
form, sending along the error messages and old input as well.

To validate a field containing a ```unique``` rule, pass the corresponding object to the form class:

```php
public function update($id)
{
    $production = Epiphyte\Production::find($id);
    $data = Input::only('name', 'author');

    $this->updateProductionForm->validate($data, $production);

    $production->name = $data['name'];
    $production->author = $data['author'];
    $production->save();

    Session::flash('success', 'Production Updated');
    return Redirect::action('ProductionController@index');
}
```