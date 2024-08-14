<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use CrudTrait;
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'items';
    protected $primaryKey = 'item_id';
    // public $timestamps = false;
    protected $guarded = ['item_id'];
    // protected $fillable = [];
    // protected $hidden = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function show($category_id)
    {
        $category = Category::with('items')->where('category_id', $category_id)->first();
        if (!$category) {
            abort(404);
        }
        return view('categories.show', compact('category'));
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id'); // Again, ensure the second argument is correct
    }

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class)->withPivot('used_quantity', 'used_unit');
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

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
