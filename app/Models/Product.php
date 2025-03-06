<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'stock', 'created_at'];

    // A product can be in multiple order items
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    // Fetch products with stock > 10
    public static function getAvailableProducts()
    {
        return self::where('stock', '>', 10)->get();
    }

    // Update stock after an order
    public function reduceStock($quantity)
    {
        return $this->decrement('stock', $quantity);
    }
}

