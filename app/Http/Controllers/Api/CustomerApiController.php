<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Http\JsonResponse;

class CustomerApiController extends Controller
{
    public function index(): JsonResponse
    {
        $customers = Customer::paginate(10);
        
        return response()->json($customers);
    }

    public function show(Customer $customer): JsonResponse
    {
        $customer->load('orders');
        
        return response()->json($customer);
    }

    public function store(StoreCustomerRequest $request): JsonResponse
    {
        // Only admin can create via API
        if (auth()->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $data = $request->validated();

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('customers', 'public');
        }

        $customer = Customer::create($data);

        return response()->json($customer, 201);
    }

    public function update(UpdateCustomerRequest $request, Customer $customer): JsonResponse
    {
        // Only admin can update via API
        if (auth()->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $data = $request->validated();

        if ($request->hasFile('profile_image')) {
            if ($customer->profile_image) {
                \Storage::disk('public')->delete($customer->profile_image);
            }
            $data['profile_image'] = $request->file('profile_image')->store('customers', 'public');
        }

        $customer->update($data);

        return response()->json($customer);
    }

    public function destroy(Customer $customer): JsonResponse
    {
        // Only admin can delete via API
        if (auth()->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($customer->profile_image) {
            \Storage::disk('public')->delete($customer->profile_image);
        }

        $customer->delete();

        return response()->json(['message' => 'Customer deleted successfully']);
    }
}