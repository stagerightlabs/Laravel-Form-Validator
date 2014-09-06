<?php namespace Srlabs\Validator;

use Illuminate\Support\ServiceProvider;
use SRLabs\Validator\Exceptions\FormValidationFailedException;

class ValidatorServiceProvider extends ServiceProvider {

	protected $redirect;

    /**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{

	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        // Find path to the package
        $filename = with(new \ReflectionClass('\SRLabs\Validator\ValidatorServiceProvider'))->getFileName();
        $path = dirname($filename);

        // Load the Package
        $this->package('srlabs/validator');

        // Register the FormValidationFailedException handler
        $this->app->error(function( FormValidationFailedException $exception)
        {
            //dd($exception->getErrors());
            $this->redirect = $this->app->make('redirect');
            return $this->redirect->back()->withInput()->withErrors($exception->getErrors());
        });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
