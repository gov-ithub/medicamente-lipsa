<?php namespace Modules\Meds\Http\Controllers\Admin;

use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Modules\Meds\Entities\Recipe;
use Modules\Meds\Repositories\RecipeRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class RecipeController extends AdminBaseController
{
    /**
     * @var RecipeRepository
     */
    private $recipe;

    public function __construct(RecipeRepository $recipe)
    {
        parent::__construct();

        $this->recipe = $recipe;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$recipes = $this->recipe->all();

        return view('meds::admin.recipes.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('meds::admin.recipes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->recipe->create($request->all());

        flash()->success(trans('core::core.messages.resource created', ['name' => trans('meds::recipes.title.recipes')]));

        return redirect()->route('admin.meds.recipe.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Recipe $recipe
     * @return Response
     */
    public function edit(Recipe $recipe)
    {
        return view('meds::admin.recipes.edit', compact('recipe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Recipe $recipe
     * @param  Request $request
     * @return Response
     */
    public function update(Recipe $recipe, Request $request)
    {
        $this->recipe->update($recipe, $request->all());

        flash()->success(trans('core::core.messages.resource updated', ['name' => trans('meds::recipes.title.recipes')]));

        return redirect()->route('admin.meds.recipe.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Recipe $recipe
     * @return Response
     */
    public function destroy(Recipe $recipe)
    {
        $this->recipe->destroy($recipe);

        flash()->success(trans('core::core.messages.resource deleted', ['name' => trans('meds::recipes.title.recipes')]));

        return redirect()->route('admin.meds.recipe.index');
    }
}
