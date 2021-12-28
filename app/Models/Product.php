<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use  HasFactory;
    public function scopePriceMin($query, $input)
    {
        return $query->where('price', '>', $input);
    }
    public function scopePriceMax($query, $input)
    {
        return $query->where('price', '<', $input);
    }
    public function scopeType($query, $input)
    {
        return $query->where('type', $input);
    }
    public function scopeName($query, $input)
    {
        return $query->where('name', $input);
    }
    public function scopeJoinCategory($query)
    {
        return $query->Leftjoin('categories', 'products.category_id', '=', 'categories.id');
    }
    public function new()
    {
        $new = new Product;
        $new->name = 'Pastel Richos Style';
        $new->desc  = 'chessecake';
        $new->price  = 40.20;
        $new->save();
    }
}
