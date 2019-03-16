<?php
/**
 * Created by PhpStorm.
 * User: escape
 * Date: 11/30/18
 * Time: 9:28 AM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\RaffleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list_categories')          ->  only(['index']);
        $this->middleware('permission:store_categories')         ->  only(['store']);
        $this->middleware('permission:update_categories')        ->  only(['update']);
    }

    public function index()
    {
        $categories = RaffleCategory::all();

        Log::info(trans('aLogs.adm_cat_index'), [Auth::user()]);

        return view('admin.categories', [
            'categories' => $categories,
            'div_showRaffles' => 'show',
            'li_activeRCategories' => 'active',
        ]);
    }

    public function store(Request $request)
    {
        $category = RaffleCategory::create($request->all());

        Log::info(trans('aLogs.adm_cat_store'), [Auth::user(), $category]);

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully');
    }

    public function update(Request $request)
    {
        $category = $request->get('category');
        $category = RaffleCategory::findOrFail($category);
        $category->category = $request->get('category');
        $category->icon = $request->get('icon');
        $category->save();

        Log::info(trans('aLogs.adm_cat_updated'), [Auth::user(), $request->all()]);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully');
    }
}