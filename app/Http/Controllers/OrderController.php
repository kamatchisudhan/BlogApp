<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Fetch all orders for a specific user.
     */
    public function getUserOrders($userId)
    {
        $orders = Order::where('user_id', $userId)->with('orderItems.product')->get();
        return response()->json($orders);
    }

    /**
     * Place a new order.
     */
    public function placeOrder(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'items'   => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity'   => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            $totalPrice = 0;

            // Calculate total price & check stock availability
            foreach ($request->items as $item) {
                $product = Product::findOrFail($item['product_id']);

                if ($product->stock < $item['quantity']) {
                    return response()->json(['message' => "Not enough stock for {$product->name}"], 400);
                }

                $totalPrice += $product->price * $item['quantity'];
            }

            // Create order
            $order = Order::create([
                'user_id'     => $request->user_id,
                'total_price' => $totalPrice,
                'status'      => 'pending',
            ]);

            // Create order items and update stock
            foreach ($request->items as $item) {
                $product = Product::findOrFail($item['product_id']);

                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $product->id,
                    'quantity'   => $item['quantity'],
                    'price'      => $product->price,
                ]);

                $product->decrement('stock', $item['quantity']);
            }

            DB::commit();
            return response()->json(['message' => 'Order placed successfully', 'order' => $order], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Order failed', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Update order status.
     */
    public function updateOrderStatus(Request $request, $orderId)
    {
        $request->validate([
            'status' => 'required|in:pending,shipped,delivered,cancelled',
        ]);

        $order = Order::findOrFail($orderId);
        $order->update(['status' => $request->status]);

        return response()->json(['message' => 'Order status updated successfully', 'order' => $order]);
    }
}
