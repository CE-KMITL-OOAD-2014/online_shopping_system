<?php
	Class ProductModelTest extends TestCase {

		public function setUp() {
			parent::setUp();
			Artisan::call('migrate');
			$this->seed();
		}

		public function testValue() {
			$this->assertTrue(true);
		}
	}