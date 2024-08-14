<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RecipeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class RecipeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RecipeCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Recipe::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/recipe');
        CRUD::setEntityNameStrings('recipe', 'recipes');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('recipe_id')->label('ID');
        CRUD::column('recipe_name')->label('レシピ名');
        CRUD::column('set.set_name')->type('relationship')
            ->label('セット'); // 表示名
        CRUD::column('recipe_image')->type('image')->label('レシピ画像');

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
        CRUD::setValidation(RecipeRequest::class);
        //CRUD::setFromDb(); // set fields from db columns.
        CRUD::field('recipe_name')->label('レシピ名');

        CRUD::field([   // Select
            'name'  => 'set_id',
            'label' => 'セット',
            'type'  => 'select',
            'entity' => 'set',
            'attribute' => 'set_name',
            'model' => "App\Models\Set",
        ]);
        CRUD::field([   // Summernote
            'name'  => 'recipe_ingredients',
            'label' => 'Ingredients',
            'type'  => 'summernote',
            'escaped' => false, // allow html tags
            'options' => [
                'minheight' => 300,
                'height' => 240
            ]
        ]);
        CRUD::field([   // Summernote
            'name'  => 'recipe_description',
            'label' => 'Description',
            'type'  => 'summernote',
            //'escaped' => false, // allow html tags
            'options' => [
                'minheight' => 300,
                'height' => 240
            ]
        ]);
        CRUD::field('recipe_image')
            ->type('upload')
            ->withFiles([
                'disk' => 'public',
                'path' => 'uploads/recipes',
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

    protected function setupShowOperation()
    {
        //CRUD::setFromDb();
        CRUD::column('recipe_name')->label('レシピ名');
        CRUD::column('set.set_name')->type('relationship')
            ->label('セット'); // 表示名
        CRUD::column('recipe_ingredients')->type('text')->label('材料');
        CRUD::column('short_description')->label('レシピ内容');
        CRUD::column('recipe_image')->type('image')->label('画像');
    }
}
