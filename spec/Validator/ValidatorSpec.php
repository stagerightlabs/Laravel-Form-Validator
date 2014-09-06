<?php namespace spec\Validator;

use PhpSpec\ObjectBehavior;
use SRLabs\Validator\Validation\FormValidator;
use SRLabs\Validator\Exceptions\FormValidationFailedException;
use Illuminate\Validation\Factory;

class ValidatorSpec extends ObjectBehavior {

    function let(Factory $laravelValidator)
    {
        $this->beAnInstanceOf('spec\Validator\TrialValidator');
        $this->beConstructedWith($laravelValidator);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('spec\Validator\TrialValidator');
    }

    function it_validates_a_set_of_valid_data(FormValidator $formValidator)
    {
        $fakeFormData = ['username' => 'joe'];

        $formValidator->make($fakeFormData, $this->getRules(), [])->willReturn($validator);
        $validator->fails()->willReturn(false);

        $this->validate($fakeFormData)->shouldReturn(true);
    }
}

class TrialValidator extends FormValidator {
    protected $rules = ['name' => 'required'];
}

class CommandStub {
    public $username = 'JohnDoe';
}