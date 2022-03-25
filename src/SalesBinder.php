<?php

namespace Achieversaim\Larasalesbinder;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class SalesBinder {
    
    protected $apikey;
    protected $subdomain;
    protected $version = '2.0';
    protected $format = '.json';
    protected $baseurl = 'https://app.salesbinder.com/api/';
    protected $secret = 'x';
    
    public function __construct()
    {
        $this->loadConfigData();
    }
    
    public function loadConfigData()
    {
        $config = loadConfigData();
        $this->apikey = array_key_exists('apikey', $config) ? $config['apikey'] : $this->apikey; 
        $this->subdomain = array_key_exists('subdomain', $config) ? $config['subdomain'] : $this->subdomain; 
    }
    
    public function create($model,array $data)
    {
        $createData = [
            Str::singular($model) => $data
        ];
        $createDataJson = json_encode($createData);
        $response =  Http::withHeaders([
            'Content-Type' => 'application/json',
            ])->withBasicAuth($this->apikey, $this->secret)->post($this->createRequestUrl($model),[Str::singular($model) => $data]);
            dd($response->body());
    }
        
    public function createRequestUrl($model)
    {
        // https://templatebench.salesbinder.com/api/
        return $this->baseurl.$this->version.'/'.$model.$this->format;
    }


}
    
    