<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Recipe extends Model
{
    use CrudTrait;
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'recipes';
    protected $primaryKey = 'recipe_id';
    // public $timestamps = false;
    protected $guarded = ['recipe_id'];
    // protected $fillable = [];
    // protected $hidden = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function set()
    {
        return $this->belongsTo('App\Models\Set', 'set_id');
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function items()
    {
        // Adjust 'item_recipe' to 'usedItems' if that's your pivot table's name
        // Also, ensure you are using the correct foreign and related keys if they are custom
        return $this->belongsToMany(Item::class, 'usedItems', 'recipe_id', 'item_id')
            ->withPivot('used_quantity', 'used_unit'); // Include pivot data if necessary
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    public function getShortDescriptionAttribute()
    {
        return Str::words($this->recipe_description, 100, '...');
    }
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
