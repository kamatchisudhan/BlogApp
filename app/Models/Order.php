<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total_price', 'status', 'created_at'];

    // An order belongs to a user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // An order has many order items
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    // Fetch all orders for a specific user
    public static function getOrdersByUser($userId)
    {
        return self::where('user_id', $userId)->with('orderItems')->get();
    }
}
