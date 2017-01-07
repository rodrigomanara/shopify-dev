<?php

namespace Urg\ShopfyBundle\Api;

use Shopify\PublicApp;
use Shopify\PrivateApp;

Abstract Class absShopify {

    protected $shopify;
    protected $api_key;
    protected $shared_secret;
    protected $password;
    protected $domain;
    protected $scope;
    protected $response;

    /**
     * 
     * @param array $shopify_config
     */
    public function __construct(array $shopify_config = array()) {
        $this->api_key = $shopify_config['api_key'];
        $this->shared_secret = $shopify_config['shared_secret'];
        $this->password = $shopify_config['password'];
        $this->domain = $shopify_config['domain'];
        $this->scope = $shopify_config['scope'];
    }

    /**
     * setPublicApp
     */
    public function setPublicApp() {
        $this->shopify = new PublicApp($this->domain, $this->api_key, $this->shared_secret);
    }

    /**
     * setPrivateApp
     */
    public function setPrivateApp() {
        $this->shopify = new PrivateApp($this->domain, $this->api_key, $this->password, $this->shared_secret);
    }

  
    /**
     * 
     * @return type
     */
    public function getApi() {
        return $this->shopify;
    }

    public function getToken() {
        $key;
        $this->shopify->setState($key);
        return $this->shopify->getAccessToken();
    }

}
