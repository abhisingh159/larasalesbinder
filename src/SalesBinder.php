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
    
    /**
     * Load ConfigSettings
     */
    public function loadConfigData()
    {
        $config = loadConfigData();
        $this->apikey = array_key_exists('apikey', $config) ? $config['apikey'] : $this->apikey; 
        $this->subdomain = array_key_exists('subdomain', $config) ? $config['subdomain'] : $this->subdomain; 
    }
    
    /**
     * Create Record Request
     *
     * @param [string] $model
     * @param array $data
     * @return object $response
     */
    public function create($model,array $data)
    {
        $response =  Http::withHeaders([
            'Content-Type' => 'application/json',
            ])->withBasicAuth($this->apikey, $this->secret)->post($this->createRequestUrl($model),[Str::singular($model) => $data]);
            return $response;
    }
    
    /**
     * Edit Record Request
     *
     * @param string $model
     * @param string $id
     * @param array $data
     * @return object $response
     */
    public function edit(string $model,string $id ,array $data)
    {
        $response =  Http::withHeaders([
            'Content-Type' => 'application/json',
            ])->withBasicAuth($this->apikey, $this->secret)->put($this->modelRouteUrl($model,$id),[Str::singular($model) => $data]);
            return $response;
    }

    /**
     * Create basic GET/POST url for request
     *
     * @param string $model
     * @return void
     */
    private function createRequestUrl(string $model)
    {
        return $this->baseurl.$this->version.'/'.$model.$this->format;
    }

    /**
     * Create get request
     *
     * @param string $model
     * @param array $data
     * @return object $response
     */
    public function get(string $model,array $data) {
        $createData = [
            Str::singular($model) => $data
        ];
        $createDataJson = json_encode($createData);
        $response =  Http::withHeaders([
            'Content-Type' => 'application/json',
            ])->withBasicAuth($this->apikey, $this->secret)->get($this->createRequestUrl($model),$data);
            return $response;
    }

    /**
     * fetch single record by id
     *
     * @param string $model
     * @param string $id
     * @return object $response
     */
    public function view(string $model,string $id) {
        $response =  Http::withHeaders([
            'Content-Type' => 'application/json',
            ])->withBasicAuth($this->apikey, $this->secret)->get($this->modelRouteUrl($model,$id));
            return $response;
    }

    /**
     * Create Request based on Model
     *
     * @param string $model
     * @param string $id
     * @return string 
     */
    public function modelRouteUrl(string $model, string $id) {
        return $this->baseurl.$this->version.'/'.$model.'/'.$id.$this->format;
    }

    /**
     * delete request
     *
     * @param string $model
     * @param string $id
     * @return void object
     */
    public function delete($model,string $id) {
        $response =  Http::withHeaders([
            'Content-Type' => 'application/json',
            ])->withBasicAuth($this->apikey, $this->secret)->delete($this->modelRouteUrl($model,$id));
            return $response;
    }
}
    
    