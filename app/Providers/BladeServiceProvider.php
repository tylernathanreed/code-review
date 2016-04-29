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
		// Compile all Directives
		$this->compileIfEmpty();
		$this->compileIfNotEmpty();
		$this->compileOptional();
		$this->compileError();
		$this->compileScript();
		$this->compileStylesheet();
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
}
