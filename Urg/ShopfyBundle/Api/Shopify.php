<?php

namespace Urg\ShopfyBundle\Api;

use Urg\ShopfyBundle\Api\absShopify;
use Shopify\ClientException;

Class Shopify extends absShopify {

    /**
     * 
     * @param type $method
     * @param array $data
     */
    public function createProduct(array $data = array()) {
        try {
            $data['variants'] = array($data['variants']);
            $data['images'][] = array('attachment' => $data['image'] , 'filename' => $data['filename'] );
            unset($data['image']);
            $response = $this->shopify->createProduct($data);
            $this->setResponse($response);
        } catch (ClientException $e) {
            dump($e);
        }
    }
     

    /**
     * 
     * @param type $method
     * @param array $data
     */
    public function getProduct($id) {
        try {
            $response = $this->shopify->getProduct($id);
            $this->setResponse($response);
        } catch (ClientException $e) {
            dump($e);
        }
    }

    /**
     * 
     * @param type $response
     */
    public function setResponse($response) {
        $this->response = $response;
    }

    /**
     * 
     * @return type
     */
    public function getResponse() {
        return $this->response;
    }

}
