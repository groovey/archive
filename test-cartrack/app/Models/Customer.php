<?php
namespace App\Models;

use App\Services\DB as Model;

/**
 * The customer class model
 */
class Customer extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Gets all the customers
     */
    public function all()
    {
        $q = "SELECT * FROM customers";
        $datas = $this->fetch($q);
        return $datas;
    }

    /**
     * Gets a single customer base on condition
     */
    public function find($id)
    {
        $q = "SELECT * FROM customers WHERE customer_id = '$id' LIMIT 1";
        $data = $this->fetch($q);
        return $data;
    }

    /**
     * Insert a customer entry
     */
    public function create($data)
    {
        $id      = $data['id'];
        $name    = $data['name'];
        $company = $data['company'];

        $q = "INSERT INTO customers (customer_id, contact_name, company_name) VALUES ('$id', '$name', '$company')";
        $result = $this->query($q);

        $data =[];
        if ($result == true) {
            $data = [
                'message' => "Succefully inserted record."
            ];
        }
        return $data;
    }

    /**
     * Update customer record by ID
     */
    public function update($id, $data)
    {
        $name = $data['name'];

        $q = "UPDATE customers SET contact_name='$name' WHERE customer_id = '$id' ";
        $result = $this->query($q);

        $data =[];
        if ($result == true) {
            $data = [
                'message' => "Succefully updated record."
            ];
        }
        return $data;
    }


    /**
     * Update customer record by ID
     */
    public function delete($id)
    {
        $q = "DELETE FROM customers WHERE customer_id = '$id' ";
        $result = $this->query($q);

        $data =[];
        if ($result == true) {
            $data = [
                'message' => "Succefully deleted record."
            ];
        }
        return $data;
    }
}
