<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Response as Json;

/**
 * Restfull json wrapper response
 */
class Response
{
    /**
     * Sends data as json response
     */
    public function send(array $datas)
    {
        $response = new Json();

        $response->setContent(json_encode(['data' =>  $datas]));
        
        $response->headers->set('Content-Type', 'application/json');
       
        return $response->send();
    }
}
