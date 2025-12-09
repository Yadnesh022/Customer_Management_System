<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\User;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Notifications\NewOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('customer');

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('orders.create', compact('customers'));
    }

    public function store(StoreOrderRequest $request)
    {
        $order = Order::create($request->validated());

        // Send notification to admin users (with error handling)
        try {
            if (config('mail.default') !== 'log') {
                $admins = User::where('role', 'admin')->get();
                if ($admins->count() > 0) {
                    Notification::send($admins, new NewOrderNotification($order));
                }
            }
        } catch (\Exception $e) {
            // Log the error but don't stop the order creation
            Log::warning('Failed to send order notification: ' . $e->getMessage());
        }

        return redirect()->route('orders.index')
            ->with('success', 'Order created successfully.');
    }

    public function show(Order $order)
    {
        $order->load('customer');
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $customers = Customer::all();
        return view('orders.edit', compact('order', 'customers'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->validated());

        return redirect()->route('orders.index')
            ->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        // Only admin can delete
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully.');
    }

    public function export(Request $request)
    {
        $format = $request->get('format', 'csv');
        
        $query = Order::with('customer');
        
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        $orders = $query->get();

        if ($format === 'csv') {
            return $this->exportCsv($orders);
        } else {
            return $this->exportPdf($orders);
        }
    }

    private function exportCsv($orders)
    {
        $filename = 'orders_' . date('Y-m-d_His') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function() use ($orders) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for Excel UTF-8 support
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Add CSV headers
            fputcsv($file, ['Order Number', 'Customer Name', 'Customer Email', 'Amount', 'Status', 'Order Date', 'Created At']);

            // Add data rows with null safety
            foreach ($orders as $order) {
                fputcsv($file, [
                    $order->order_number,
                    $order->customer?->name ?? 'Unknown',
                    $order->customer?->email ?? '',
                    $order->amount,
                    ucfirst($order->status),
                    $order->order_date?->format('Y-m-d'),
                    $order->created_at?->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportPdf($orders)
    {
        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Orders Report</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                .header { text-align: center; margin-bottom: 30px; border-bottom: 3px solid #10B981; padding-bottom: 10px; }
                h1 { color: #aada19ff; margin: 0; font-size: 28px; }
                .date { color: #666; font-size: 12px; margin-top: 5px; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 11px; }
                th { background-color: #dae10bff; color: white; padding: 12px; text-align: left; text-transform: uppercase; }
                td { border: 1px solid #ddd; padding: 10px; }
                tr:nth-child(even) { background-color: #f9fafb; }
                .status-pending { color: #1a30dbff; font-weight: bold; }
                .status-completed { color: #dceb0cff; font-weight: bold; }
                .status-cancelled { color: #e06f05ff; font-weight: bold; }
                .total { background-color: #D1FAE5; font-weight: bold; padding: 12px; text-align: right; }
                .footer { margin-top: 30px; text-align: center; font-size: 10px; color: #666; border-top: 1px solid #ddd; padding-top: 10px; }
            </style>
        </head>
        <body>
            <div class="header">
                <h1>Orders Report</h1>
                <p class="date">Generated on: ' . date('F d, Y \a\t H:i:s') . '</p>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Customer</th>
                        <th>Email</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>';

        $totalAmount = 0;
        if ($orders->count() > 0) {
            foreach ($orders as $order) {
                $statusClass = 'status-' . $order->status;
                $totalAmount += $order->amount;
                $customerName = $order->customer?->name ?? 'Unknown';
                $customerEmail = $order->customer?->email ?? '';
                
                $html .= '<tr>
                    <td><strong>' . htmlspecialchars($order->order_number) . '</strong></td>
                    <td>' . htmlspecialchars($customerName) . '</td>
                    <td>' . htmlspecialchars($customerEmail) . '</td>
                    <td>' . number_format($order->amount, 2) . '</td>
                    <td class="' . $statusClass . '">' . ucfirst($order->status) . '</td>
                    <td>' . $order->order_date->format('M d, Y') . '</td>
                </tr>';
            }
            
            $html .= '<tr>
                <td colspan="2" class="total">Total Orders: ' . count($orders) . '</td>
                <td colspan="2" class="total">Total Amount:' . number_format($totalAmount, 2) . '</td>
                <td colspan="2"></td>
            </tr>';
        } else {
            $html .= '<tr>
                <td colspan="6" style="text-align: center; padding: 30px; color: #999;">
                    No orders found
                </td>
            </tr>';
        }
        
        $html .= '
                </tbody>
            </table>
            <div class="footer">
                <p> Order Management System</p>
                <p>This is a computer-generated report. No signature required.</p>
            </div>
        </body>
        </html>';

        $filename = 'orders_' . date('Y-m-d_His') . '.pdf';
        
        // Check if dompdf is installed
        if (class_exists('\Barryvdh\DomPDF\Facade\Pdf')) {
            $pdf = \PDF::loadHTML($html)->setPaper('a4', 'landscape');
            return $pdf->download($filename);
        }
        
        // Fallback: Return as HTML
        return response($html)
            ->header('Content-Type', 'text/html')
            ->header('Content-Disposition', 'inline; filename="' . str_replace('.pdf', '.html', $filename) . '"');
    }
}
