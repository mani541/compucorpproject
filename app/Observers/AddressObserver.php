<?php 
namespace App\Observers;
use App\Address;
use Log;
use Illuminate\Support\Facades\Redirect;
class AddressObserver{
    private $elasticsearch;
    public function __construct()
    {
	    $hosts=['host'=>'http://laravel.edubookers.com'];
        $elasticsearch = \Elasticsearch\ClientBuilder::create()->setHosts($hosts)->build();
        $this->elasticsearch = $elasticsearch;
    }

    public function created(Address $address)
    {
        $res = $this->elasticsearch->index([
            'index' => 'userinfo',
            'type' => 'address',
            'id' => $address->id,
            'body' => $address->toArray()
        ]);
        if($res['created']!=1){
		 return Redirect::back()->withErrors(['Insertion failed. Please try again.']);
		}else{
		$this->elasticsearch->indices()->refresh(array('index' => 'userinfo'));
		Log::info('Elastic Insertion succesful');
		}
    }

    public function updated(Address $address)
    {
	var_dump('updated');
        $this->elasticsearch->index([
            'index' => 'address',
            'type' => 'address',
            'id' => $address->id,
            'body' => $address->toArray()
        ]);
    }

    public function deleted(Address $address)
    {
        $this->elasticsearch->delete([
            'index' => 'address',
            'type' => 'address',
            'id' => $address->id
        ]);
    }
}
?>