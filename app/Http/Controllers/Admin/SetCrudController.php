<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SetRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SetCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SetCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Set::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/set');
        CRUD::setEntityNameStrings('set', 'sets');
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
        CRUD::column('set_id')->label('セットID');
        CRUD::column('set_name')->label('セット名');
        CRUD::column('set_price')->type('number')->label('セット価格');
        CRUD::column('set_description')->type('text')->label('セット説明');
        CRUD::column('set_image')->type('image')->label('セット画像');

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
        CRUD::setValidation(SetRequest::class);
        CRUD::field('set_name')->label('セット名');
        CRUD::field('set_price')->type('number')->label('セット価格');
        CRUD::field('set_description')->type('text')->label('セット説明');
        CRUD::field('set_image')
            ->type('upload')
            ->withFiles([
                'disk' => 'public',
                'path' => 'uploads/sets',
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
