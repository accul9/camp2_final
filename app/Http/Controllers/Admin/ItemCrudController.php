<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\ItemRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ItemCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ItemCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Item::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/item');
        CRUD::setEntityNameStrings('item', 'items');
    }


    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('item_id')->label('ID');
        CRUD::column('item_name')->label('商品名');
        CRUD::column('category.name')->type('relationship')
            ->label('分類'); // 表示名
        CRUD::column('item_unit')->label('単位');
        CRUD::column('item_price')->label('単価');
        // CRUD::column('item_stock')->label('在庫数');
        CRUD::column('item_image')->type('image')->label('商品画像');

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
        CRUD::setValidation(ItemRequest::class);
        CRUD::setFromDb(); // set fields from db columns.
        CRUD::field([  // Select
            'label'     => "Category",
            'type'      => 'select',
            'name'      => 'category_id', // the db column for the foreign key

            // optional
            // 'entity' should point to the method that defines the relationship in your Model
            // defining entity will make Backpack guess 'model' and 'attribute'
            'entity'    => 'category',

            // optional - manually specify the related model and attribute
            'model'     => "App\Models\Category", // related model
            'attribute' => 'name', // foreign key attribute that is shown to user
        ]);
        CRUD::field([   // Summernote
            'name'  => 'item_description',
            'label' => 'Description',
            'type'  => 'textarea',
            'options' => [
                'minheight' => 300,
                'height' => 240
            ]
        ]);
        CRUD::field('item_image')
            ->type('upload')
            ->withFiles([
                'disk' => 'public',
                'path' => 'uploads/items',
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
