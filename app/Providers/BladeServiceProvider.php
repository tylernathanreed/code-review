<?php

namespace App\Providers;

use Blade;
use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;

/*
|--------------------------------------------------------------------------
| Blade Service Provider
|--------------------------------------------------------------------------
|
| The Blade Service Provider creates new Blade Directives to be used in
| any View. Each Directive is specified separately, and then booted
| in the main boot method, which is at the beginning of the class.
|
*/
class BladeServiceProvider extends ServiceProvider
{
	//////////////////
	//* Attributes *//
	//////////////////
	/**
	 * A list of Bootstrap Classes to add Opening and Closing Directives for.
	 *
	 * @var array
	 */
	protected $bootstrap = [
		'jumbotron', 'container', 'panel', 'tail'
	];

	///////////////////
	//* Boot Method *//
	///////////////////
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// Boot all Compiler Methods
		$this->bootCompilers();
	}

	/**
	 * Calls all Methods within this Class that start with 'compile'
	 * and are followed by a Capital Letter.
	 *
	 * @return void
	 */
	protected function bootCompilers()
	{
		// Determine all Class Methods
		$methods = get_class_methods(static::class);

		// Only use Methods that start with 'compile' and a Capital Letter
		$filter = array_filter($methods, function($method) {
			return substr($method, 0, 7) === 'compile' && substr($method, 7, 1) === strtoupper(substr($method, 7, 1));
		});

		// Call each Method
		foreach($filter as $method)
			$this->$method();
	}

	///////////////////////
	//* Register Method *//
	///////////////////////
	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	//////////////////
	//* Directives *//
	//////////////////
	/**
	 * Adds Opening and Closing Directives for common Bootstrap Classes.
	 *
	 * @return void
	 */
	private function compileBootstrap()
	{
		// Compile each Bootstrap Class
		foreach($this->bootstrap as $class)
		{
			// Add Opening Directive
			Blade::directive($class, function($expression) use ($class)
			{
				return $this->processAttribute(['class' => $class], $expression);
			});

			// Add Closing Directive
			Blade::directive("end{$class}", function($expression) use ($class)
			{
				return "</div> <!-- </{$class}> -->";
			});
		}
	}

	/**
	 * Add @jumbotron and @endjumbotron for Jumbotrons.
	 *
	 * @return void
	 */
	private function compileJumbotron()
	{
		// Add @jumbotron for Jumbotrons
		Blade::directive('jumbotron', function($expression)
		{
			return $this->processAttribute(['class' => 'jumbotron'], $expression);
		});

		// And @endjumbotron for Jumbotrons
		Blade::directive('endjumbotron', function($expression)
		{
			return "</div> <!-- </jumbotron> -->";
		});
	}

	/**
	 * Add @ifempty and @endifempty for Loops.
	 *
	 * @return void
	 */
	private function compileIfEmpty()
	{
		// Add @ifempty for Loops
		Blade::directive('ifempty', function($expression)
		{
			return "<?php if(count$expression == 0): ?>";
		});

		// Add @endifempty for Loops
		Blade::directive('endifempty', function($expression)
		{
			return '<?php endif; ?>';
		});
	}

	/**
	 * Add @ifnotempty and @endifnotempty for Loops.
	 *
	 * @return void
	 */
	private function compileIfNotEmpty()
	{
		// Add @ifnotempty for Loops
		Blade::directive('ifnotempty', function($expression)
		{
			return "<?php if(count$expression > 0): ?>";
		});

		// Add @endifnotempty for Loops
		Blade::directive('endifnotempty', function($expression)
		{
			return '<?php endif; ?>';
		});
	}

	/**
	 * Add @optional and @endoption for Complex Yielding.
	 *
	 * @return void
	 */
	private function compileOptional()
	{
		// Add @optional for Complex Yielding
		Blade::directive('optional', function($expression)
		{
			return "<?php if(trim(\$__env->yieldContent{$expression})): ?>";
		});

		// Add @endoptional for Complex Yielding
		Blade::directive('endoptional', function($expression)
		{
			return "<?php endif; ?>";
		});
	}

	/**
	 * Add @error for Form Errors.
	 *
	 * @return void
	 */
	private function compileError()
	{
		// Add @error for Form Errors
		Blade::directive('error', function($expression)
		{
			return "<?php if(\$errors->has$expression): ?><span class=\"help-block\"><strong><?php echo \$errors->first$expression; ?></strong></span><?php endif; ?>";
		});
	}

	/**
	 * Add @script for <script> Libraries.
	 *
	 * @return void
	 */
	private function compileScript()
	{
		// Add @script for <script> Libraries.
		Blade::directive('script', function($expression)
		{
			// Strip Open and Close Parenthesis
			if(Str::startsWith($expression, '('))
				$expression = substr($expression, 1, -1);

			return "<script src={$expression}></script>";
		});
	}

	/**
	 * Add @stylesheet for <link> Stylesheets.
	 *
	 * @return void
	 */
	private function compileStylesheet()
	{
		// Add @stylesheet for Form Errors
		Blade::directive('stylesheet', function($expression)
		{
			// Strip Open and Close Parenthesis
			if(Str::startsWith($expression, '('))
				$expression = substr($expression, 1, -1);

			return "<link href={$expression} rel=\"stylesheet\" type=\"text/css\">";
		});
	}

	//////////////////
	//* Processors *//
	//////////////////
	/**
	 * Converts the specified HTML Tag Expression to an actual HTML Div Tag.
	 *
	 * @param  array   $base        The Base Attributes that the Tag should have.
	 * @param  string  $expression  The Custom Attributes provided by the Consumer.
	 *
	 * @return string
	 */
	protected function processAttribute($base, $expression)
	{
		// Convert the Expression to an Object
		$object = $this->processArray($expression);

		// Check for a Null Object
		if(is_null($object))
			return $this->processDiv($base);

		// Mix the Base Attributes with the Object
		foreach($base as $attribute => $value)
		{
			// Check to see if the Object does not have this Attribute
			if(!isset($object->$attribute))
			{
				// Simply Assign it
				$object->$attribute = $value;
				continue;
			}

			// Check for the Class Attribute
			if($attribute === 'class')
			{
				// Append Expressed Classes
				$object->class = $value . ' ' . $object->class;
				continue;
			}

			// Check for the ID Attribute (and Extension)
			if($attribute === 'id' && substr($object->id, 0, 2) === "--")
			{
				$object->id = $value . $object->id;
			}

			// Everything else is Overridden
		}

		return $this->processDiv($object);
	}

	/**
	 * Converts the specified Object to an HTML Div Tag.
	 *
	 * @param  Object  $object  The specified Object.
	 *
	 * @return string
	 */
	protected function processDiv($object)
	{
		// Flatten to a Div Element
		$element = '<div';

		foreach($object as $attribute => $value)
			$element .= " $attribute=\"$value\"";

		$element .= '>';

		// Return the Element
		return $element;
	}

	/**
	 * Converts the specified PHP Array Expression to an Object.
	 *
	 * @param  string  $expression  The specified PHP Array Expression.
	 *
	 * @return null|Object
	 */
	protected function processArray($expression)
	{
		// Make sure an Expression was Defined
		if($expression === '')
			return null;

		// Strip Open and Close Parenthesis
		if(Str::startsWith($expression, '('))
			$expression = substr($expression, 1, -1);

		// Convert PHP String to JSON
		$json = str_replace(['[', ']', '=>', '\''], ['{', '}', ':', '"'], $expression);

		// Convert the Expression to an Object
		return json_decode($json);
	}
}
