@extends('layouts.app')

@section('header')
	@jumbotron
		@container
			<h1>Code Assessment</h1>
			<p>Created by Tyler Reed - for Sherman Bridge</p>
			<p>
				<a class="btn btn-primary btn-lg" href="{{ route('invoices.index') }}" role="button">
					<i class="glyphicon glyphicon-list"></i>
					<span>View Invoices</span>
				</a>
			</p>
		@endcontainer
	@endjumbotron
@endsection

@section('content')

	@panel(['class' => 'panel-default'])
		<div class="panel-heading">
			<h2 class="panel-title">PHP Coding Exercise: Hourly Invoice</h2>
		</div>
		<div class="panel-body">
			<p>
				This project was created for a Code Assessment for Sherman Bridge. The original specifications of the project can be found <a target="_blank" href="https://docs.google.com/document/d/1wcwS9DNdlEsskdxl_mhdunMpCVH1GOBi8vub_CL-RUQ">here</a>. An additional requirements specification was created for this project specifically, which can be found <a target="_blank" href="https://docs.google.com/document/d/12mR6VuzRoI2SC8Iox_C6IFCDgLEFayJFB-6mHp04Kbs">here</a>.
			</p>

			<p>
				If you wish to download this project, and try it for yourself, please refer to the <a target="_blank" href="https://docs.google.com/document/d/1DHfC1Ds7O3M41Gh69BTF8_xZAitTmDy6QgGZ3A6-v8E">Installation &amp; Setup Guide</a>.
			</p>

			<section id="user-stories">
				<h3>User Stories</h3>
				<ul class="--list-style-none --padding-half">
					<li>
						<i class="glyphicon glyphicon-ok"></i>&nbsp;
						<span>User fills out an 'hourly invoice' form with their name, address, hourly rate, customer's contact info, and a log of work (date, hours, description)</span>
						<ul>
							<li>Visit the <a href="{{ route('invoices.create') }}">Invoice Create Page</a></li>
						</ul>
					</li>
					<li>
						<i class="glyphicon glyphicon-ok"></i>&nbsp;
						<span>User sees total hours and invoice amount in real-time live without submitting form</span>
						<ul>
							<li>Done using <a target="_blank" href="https://vuejs.org/">Vue.js</a></li>
						</ul>
					</li>
					<li>
						<i class="glyphicon glyphicon-ok"></i>&nbsp;
						<span>User clicks "generate PDF" and a PDF invoice is downloaded</span>
						<ul>
							<li>Done on the <a href="{{ route('invoices.index') }}">Invoice Index Page</a>, or the respective Invoice's Show page.</li>
						</ul>
					</li>
				</ul>
			</section>

			<section id="requirements">
				<h3>Requirements</h3>
				<ul class="--list-style-none --padding-half">
					<li>
						<i class="glyphicon glyphicon-ok"></i>&nbsp;
						<span>Use a PHP framework</span>
						<ul>
							<li><a target="_blank" href="https://laravel.com/">Laravel 5.2</a></li>
						</ul>
					</li>
					<li>
						<i class="glyphicon glyphicon-ok"></i>&nbsp;
						<span>Use one or more frontend libraries (bootstrap, angular, jquery, etc)</span>
						<ul>
							<li><a target="_blank" href="http://getbootstrap.com/">Boostrap 3</a></li>
							<li><a target="_blank" href="https://vuejs.org/">Vue.js 1.0</a></li>
							<li><a target="_blank" href="https://jquery.com/">jQuery 2.2</a></li>
						</ul>
					</li>
					<li>
						<i class="glyphicon glyphicon-ok"></i>&nbsp;
						<span>If you omit something for brevity (like xss filtering), just put a comment to indicate you’re aware of it</span>
						<ul>
							<li>Editting existing Invoices was excluded</li>
							<li>Test Cases using PHPUnit was excluded</li>
						</ul>
					</li>
					<li>
						<i class="glyphicon glyphicon-ok"></i>&nbsp;
						<span>Use a PDF library of your choice</span>
						<ul>
							<li>
								<a target="_blank" href="https://github.com/barryvdh/laravel-dompdf">barryvdh/laravel-dompdf</a>
								<span> was pulled in via composer, which is a wrapper around </span>
								<a target="_blank" href="https://github.com/dompdf/dompdf">DOM PDF</a>.
							</li>
						</ul>
					</li>
				</ul>
			</section>

			<section id="bonus">
				<h3>Bonus</h3>
				<ul class="--list-style-none --padding-half">
					<li>
						<i class="glyphicon glyphicon-remove"></i>&nbsp;
						<span>Use AngularJS or React</span>
						<ul>
							<li>Used <a target="_blank" href="https://vuejs.org/">Vue.js</a> instead.</li>
						</ul>
					</li>
					<li>
						<i class="glyphicon glyphicon-ok"></i>&nbsp;
						<span>Use Bootstrap UI</span>
					</li>
					<li>
						<i class="glyphicon glyphicon-ok"></i>&nbsp;
						<span>Host it somewhere</span>
						<ul>
							<li>You're looking at it.</li>
						</ul>
					</li>
					<li>
						<i class="glyphicon glyphicon-ok"></i>&nbsp;
						<span>Store and show previous Invoices</span>
						<ul>
							<li>
								<span>This is done on the <a href="{{ route('invoices.index') }}">Invoice Index Page</a>, where individual Invoices may be viewed on their respective Show Page.</span>
							</li>
						</ul>
					</li>
					<li>
						<i class="glyphicon glyphicon-ok"></i>&nbsp;
						<span>Use Vagrant</span>
						<ul>
							<li>
								<span>Used <a target="_blank" href="https://laravel.com/docs/5.2/homestead">Laravel Homestead</a> for boxing on <a target="_blank" href="https://www.virtualbox.org/">Virtual Box</a></span>
							</li>
						</ul>
					</li>
					<li>
						<i class="glyphicon glyphicon-ok"></i>&nbsp;
						<span>Use Composer, Npm, Bower, or other Package Managers</span>
						<ul>
							<li>
								<span>Used <a target="_blank" href="https://getcomposer.org/">Composer</a></span>
								<span>Used <a target="_blank" href="https://nodejs.org/">Node.js / Npm</a></span>
							</li>
						</ul>
					</li>
					<li>
						<i class="glyphicon glyphicon-asterisk"></i>&nbsp;
						<span>Use Symfony and Doctrine</span>
						<ul>
							<li>
								<span><a target="_blank" href="https://laravel.com/">Laravel</a> is built on several Symfony and Doctrine components</span>
								<ul>
									<li>symfony/console</li>
									<li>symfony/debug</li>
									<li>symfony/finder</li>
									<li>symfony/http-foundation</li>
									<li>symfony/http-kernel</li>
									<li>symfony/polyfill-php56</li>
									<li>symfony/process</li>
									<li>symfony/routing</li>
									<li>symfony/translation</li>
									<li>symfony/var-dumper</li>
									<li>doctrine/inflector</li>
									<li>doctrine/instantiator</li>
								</ul>
							</li>
						</ul>
					</li>
					<li>
						<i class="glyphicon glyphicon-ok"></i>&nbsp;
						<span><b>Use Docblocks</b></span>
						<ul><li>Done on <i><b>everything</b></i></li></ul>
					</li>
				</ul>
			</section>

			<section id="submission">
				<h3>Submission</h3>
				<ul class="--list-style-none --padding-half">
					<li>
						<i class="glyphicon glyphicon-ok"></i>&nbsp;
						<span>Submit code via a Github Repository</span>
						<ul>
							<li>See it <a target="_blank" href="https://github.com/tylernathanreed/code-review/">here</a>.</li>
						</ul>
					</li>
					<li>
						<i class="glyphicon glyphicon-ok"></i>&nbsp;
						<span>Send Instructions on how to Setup/Install</span>
						<ul>
							<li>Check out the <a target="_blank" href="https://docs.google.com/document/d/1DHfC1Ds7O3M41Gh69BTF8_xZAitTmDy6QgGZ3A6-v8E">Installation &amp; Setup Guide</a>.</li>
						</ul>
					</li>
					<li>
						<i class="glyphicon glyphicon-ok"></i>&nbsp;
						<span>Give an estimate of the total time spent on this.</span>
						<ul>
							<li>18 Hours, which includes the external documentation.</li>
						</ul>
					</li>
				</ul>
			</section>
		</div>
	@endpanel

@endsection