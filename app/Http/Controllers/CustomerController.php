<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $customers = $query->latest()->paginate(10);

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    
public function store(Request $request)
{
    $validated = $request->validate([
        'name'          => ['required', 'string', 'max:255','regex:/^[A-Za-z\s]+$/'],
        'email'         => ['required', 'email', 'max:255', 'unique:customers,email'],
        'phone'         => ['required', 'regex:/^[6-9]\d{9}$/'], // Indian 10‑digit mobile
        'profile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        'address'       => ['required', 'string', 'min:10'],
    ], [
        'name.required'          => 'Full name is required.',
        'email.required'         => 'Email address is required.',
        'email.email'            => 'Please enter a valid email address.',
        'email.unique'           => 'This email is already registered.',
        'phone.required'         => 'Phone number is required.',
        'phone.regex'            => 'Enter a valid 10 digit Indian mobile number starting with 6–9.',
        'profile_image.image'    => 'The profile file must be an image.',
        'profile_image.mimes'    => 'Profile image must be JPG or PNG.',
        'profile_image.max'      => 'Profile image size must not exceed 2MB.',
        'address.required'       => 'Address is required.',
        'address.min'            => 'Address must be at least 10 characters.',
    ]);
 $data = $validated;

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('customers', 'public');
        }

        Customer::create($data);

        return redirect()->route('customers.index')
            ->with('success', 'Customer created successfully.');
    // Save customer using $validated...
}

    public function show(Customer $customer)
    {
        $customer->load('orders');
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $data = $request->validated();

        if ($request->hasFile('profile_image')) {
            // Delete old image
            if ($customer->profile_image) {
                Storage::disk('public')->delete($customer->profile_image);
            }
            $data['profile_image'] = $request->file('profile_image')->store('customers', 'public');
        }

        $customer->update($data);

        return redirect()->route('customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        // Only admin can delete
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        if ($customer->profile_image) {
            Storage::disk('public')->delete($customer->profile_image);
        }

        $customer->delete();

        return redirect()->route('customers.index')
            ->with('success', 'Customer deleted successfully.');
    }

  public function export(Request $request)
{
    $format = $request->get('format', 'csv');
    
    $query = Customer::query();
    
    // Apply search if exists
    if ($request->has('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        });
    }
    
    $customers = $query->get();

    if ($format === 'csv') {
        return $this->exportCsv($customers);
    } else {
        return $this->exportPdf($customers);
    }
}



private function exportPdf($customers)
{
    $html = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Customers Report</title>
        <style>
            body { 
                font-family: Arial, sans-serif;
                margin: 20px;
            }
            .header {
                text-align: center;
                margin-bottom: 30px;
                border-bottom: 3px solid #b7d417ff;
                padding-bottom: 10px;
            }
            h1 { 
                color: #def41dff;
                margin: 0;
                font-size: 28px;
            }
            .date { 
                color: #666;
                font-size: 12px;
                margin-top: 5px;
            }
            table { 
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            th { 
                background-color: #ecec1aff;
                color: white;
                padding: 12px;
                text-align: left;
                font-size: 12px;
                text-transform: uppercase;
            }
            td { 
                border: 1px solid #ddd;
                padding: 10px;
                font-size: 11px;
            }
            tr:nth-child(even) { 
                background-color: #f9fafb;
            }
            .footer {
                margin-top: 30px;
                text-align: center;
                font-size: 10px;
                color: #666;
                border-top: 1px solid #ddd;
                padding-top: 10px;
            }
            .total {
                background-color: #E0E7FF;
                font-weight: bold;
                text-align: right;
                padding: 12px;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <h1> Customers Report</h1>
            <p class="date">Generated on: ' . date('F d, Y \a\t H:i:s') . '</p>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">ID</th>
                    <th style="width: 20%;">Name</th>
                    <th style="width: 25%;">Email</th>
                    <th style="width: 15%;">Phone</th>
                    <th style="width: 25%;">Address</th>
                    <th style="width: 10%;">Joined</th>
                </tr>
            </thead>
            <tbody>';
    
    if ($customers->count() > 0) {
        foreach ($customers as $customer) {
            $html .= '<tr>
                <td>' . $customer->id . '</td>
                <td><strong>' . htmlspecialchars($customer->name) . '</strong></td>
                <td>' . htmlspecialchars($customer->email) . '</td>
                <td>' . htmlspecialchars($customer->phone) . '</td>
                <td>' . htmlspecialchars($customer->address) . '</td>
                <td>' . $customer->created_at->format('M d, Y') . '</td>
            </tr>';
        }
        
        $html .= '<tr>
            <td colspan="5" class="total">Total Customers:</td>
            <td class="total">' . $customers->count() . '</td>
        </tr>';
    } else {
        $html .= '<tr>
            <td colspan="6" style="text-align: center; padding: 30px; color: #999;">
                No customers found
            </td>
        </tr>';
    }
    
    $html .= '
            </tbody>
        </table>
        
        <div class="footer">
            <p>Customer Management System </p>
            <p>This is a computer-generated report. No signature required.</p>
        </div>
    </body>
    </html>';

    $filename = 'customers_' . date('Y-m-d_His') . '.pdf';
    
    // Check if dompdf is installed
    if (class_exists('\Barryvdh\DomPDF\Facade\Pdf')) {
        $pdf = \PDF::loadHTML($html)->setPaper('a4', 'landscape');
        return $pdf->download($filename);
    }
    
    // Fallback: Return as HTML (can be saved as PDF from browser)
    return response($html)
        ->header('Content-Type', 'text/html')
        ->header('Content-Disposition', 'inline; filename="' . str_replace('.pdf', '.html', $filename) . '"');
}
}