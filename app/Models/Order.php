<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'item_id');
    }

    public function set()
    {
        return $this->belongsTo(Set::class, 'set_id', 'set_id');
    }
}
