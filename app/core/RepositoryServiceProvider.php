<?php 

	namespace core;

	use Illuminate\Support\ServiceProvider;

	Class RepositoryServiceProvider extends ServiceProvider {
		public function register() {
			$this->app->bind('\core\EloProductRepo','\core\ProductRepoInterface');
		}
	}