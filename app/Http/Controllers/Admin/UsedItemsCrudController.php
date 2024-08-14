<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UsedItemsRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UsedItemsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UsedItemsCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\UsedItems::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/used-items');
        CRUD::setEntityNameStrings('used items', 'used items');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        //CRUD::setFromDb(); // set columns from db columns.
        CRUD::column("usedItem_id")->label('Used Item ID');
        CRUD::column('recipe.recipe_name')->type('relationship')
            ->label('recipe'); // 表示名
        CRUD::column('item.item_name')->type('relationship')->label('item');
        CRUD::column('used_quantity');
        CRUD::column('used_unit');

        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(UsedItemsRequest::class);
        //CRUD::setFromDb(); // set fields from db columns.
        CRUD::field([  // Select
            'label'     => "Recipe",
            'type'      => 'select',
            'name'      => 'recipe_id', // the db column for the foreign key

            // optional
            // 'entity' should point to the method that defines the relationship in your Model
            // defining entity will make Backpack guess 'model' and 'attribute'
            'entity'    => 'recipe',

            // optional - manually specify the related model and attribute
            'model'     => "App\Models\Recipe", // related model
            'attribute' => 'recipe_name', // foreign key attribute that is shown to user
        ]);
        CRUD::field([  // Select
            'label'     => "Item",
            'type'      => 'select',
            'name'      => 'item_id', // the db column for the foreign key

            // optional
            // 'entity' should point to the method that defines the relationship in your Model
            // defining entity will make Backpack guess 'model' and 'attribute'
            'entity'    => 'item',

            // optional - manually specify the related model and attribute
            'model'     => "App\Models\Item", // related model
            'attribute' => 'item_name', // foreign key attribute that is shown to user
        ]);
        CRUD::field('used_quantity')->type('text')->label('Quantity');
        CRUD::field([
            'name'        => 'used_unit',
            'label'       => 'Unit',
            'type'        => 'select_from_array',
            'options'     => ['-' => '-', '個' => '個', '袋' => '袋', '本' => '本', 'パック' => 'パック', '小さじ' => '小さじ', '大さじ' => '大さじ', 'cc' => 'cc', 'ml' => 'ml', 'g' => 'g', '枚' => '枚', '合' => '合', '切れ' => '切れ', '束' => '束', '缶' => '缶', 'カップ' => 'カップ', '玉' => '玉', 'かけ' => 'かけ', '適量' => '適量'],
            'allows_null' => false,
            'default'     => 'g',
        ]);

        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
