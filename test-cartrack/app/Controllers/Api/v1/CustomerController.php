<?php

namespace App\Controllers\Api\v1;

use App\Models\Customer;
use App\Services\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Customer API controller
 */
class CustomerController
{
    private $request;
    private $response;
    private $customer;
    
    public function __construct(Request $request)
    {
        $this->request  = $request;
        $this->response = new Response();
        $this->customer = new Customer();
    }

    /**
     * Gets all customers
     * ex. http://tester.test/api/v1/customers
     */
    public function index()
    {
        $customer = $this->customer;
        $response = $this->response;
        $datas    = $customer->all();
        
        return $response->send($datas);
    }

    /**
    * Retrieves a single customers details base conditions
    * ex. http://tester.test/api/v1/customers?id=1
    */
    public function find()
    {
        $request  = $this->request;
        $response = $this->response;
        $customer = $this->customer;
        $id       = $request->get('id');
        $data     = $customer->find($id);

        return $response->send($data);
    }

    /**
    * Insert customer record
    * Note:: use POST action on postman
    * ex. http://tester.test/api/v1/customers?name=sample
    */
    public function create()
    {
        $request  = $this->request;
        $response = $this->response;
        $customer = $this->customer;
        $name     = $request->get('name');
        $rand     = rand();

        $data = $customer->create([
            'id'      => $rand,
            'name'    => $name,
            'company' => $rand,
        ]);

        return $response->send($data);
    }

    /**
    * Update customer record
    * Note:: use PUT action on postman
    * ex. http://tester.test/api/v1/customers?name=updated_sample&id=9
    */
    public function update()
    {
        $request  = $this->request;
        $response = $this->response;
        $customer = $this->customer;
        $id       = $request->get('id');
        $name     = $request->get('name');

        $data = $customer->update($id, [
            'name' => $name
        ]);

        return $response->send($data);
    }

    /**
    * Delete customer record
    * Note:: use DELETE action on postman
    * ex. http://tester.test/api/v1/customers?id=9
    */
    public function delete()
    {
        $request  = $this->request;
        $response = $this->response;
        $customer = $this->customer;
        $id       = $request->get('id');
        $data     = $customer->delete($id);

        return $response->send($data);
    }
}
