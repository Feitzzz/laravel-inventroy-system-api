<?php
namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function createCustomer(CreateCustomerRequest $request)
    {
        $validatedData = $request->validated();

        $customer = Customer::create($validatedData);

        return response()->json([
            'message'  => 'Customer created successfully',
            'customer' => new CustomerResource($customer),
        ], 201);
    }

    public function getCustomers()
    {
        $customers = Customer::all();

        return CustomerResource::collection($customers);
    }

    public function getCustomer(Customer $customer)
    {
        return new CustomerResource($customer);
    }

    public function updateCustomer(UpdateCustomerRequest $request, Customer $customer)
    {
        $validatedData = $request->validated();

        $customer->update($validatedData);

        return response()->json([
            'message'  => 'Customer updated successfully',
            'customer' => new CustomerResource($customer),
        ]);
    }

    public function deleteCustomer(Customer $customer)
    {
        $customer->delete();

        return response()->json([
            'message' => 'Customer deleted successfully',
        ]);
    }

}
