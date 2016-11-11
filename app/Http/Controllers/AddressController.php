<?php

namespace App\Http\Controllers;
use App\Http\Requests\AddressFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Address;

class AddressController extends Controller
{
    public function index()
    {
	    $hosts=['host'=>'http://laravel.edubookers.com'];
        $elasticsearch = \Elasticsearch\ClientBuilder::create()->setHosts($hosts)->build();
        $client = $elasticsearch;
		$params = ['index' => 'userinfo'];
		$res = $client->indices()->exists($params);
		$address =array();
		if($res){
			$params = [
				'index' => 'userinfo',
				'type' => 'address',
				'size' => 1000,
				'sort'=>['_uid']
			];
			$response = $client->search($params);
			for($i=0;$i<count($response['hits']['hits']);$i++){
				$address[$i]= $response['hits']['hits'][$i];
			}
			return view('address.formaddress',['address'=>$address]);
        }
		else{
		    return view('address.formaddress');
		}
	}

    public function store(AddressFormRequest $request)
    {
	  $formdata = $request->all();
	  $address = new Address();
	  $address->create($formdata);
	  return Redirect::action('AddressController@index')->with('message', 'Address Updated.');
    }
}
