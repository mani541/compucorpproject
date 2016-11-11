<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/', 
  ['as' => 'address', 'uses' => 'AddressController@index']);
Route::post('/store', 
  ['as' => 'address_store', 'uses' => 'AddressController@store']);
/*Route::get('/address', function () {
    $hosts=['host'=>'http://laravel.edubookers.com/'];
    $client = Elasticsearch\ClientBuilder::create()->setHosts($hosts)->build();
	$results = $client->search([
	"index"=>'dankoo',
	"body"=>[
	        "query"=>[
			         "match"=>[
					           "_all"=>"design"
							   ]
					 ]
			]
		]);
		var_dump($results);
	//return view('welcome');

});
*/