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
use Illuminate\Support\Facades\Log;


class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list_categories')->only(['index']);
        $this->middleware('permission:store_categories')->only(['store']);
        $this->middleware('permission:update_categories')->only(['update']);
    }

    public function index()
    {
        $categories = RaffleCategory::all();

        return view('admin.categories', [
            'categories' => $categories,
            'div_showRaffles' => 'show',
            'li_activeRCategories' => 'active',
        ]);
    }

    public function store(Request $request)
    {
        $category = RaffleCategory::create($request->all());

        Log::log('INFO', trans('aLogs.adm_cat_store'),
            [
                'user' => Auth::user()->id,
                'category' => $category,
            ]);

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully');
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $category = RaffleCategory::findOrFail($id);
        $category->category = $request->get('category');
        $category->icon = $request->get('icon');
        $category->save();

        Log::log('INFO', trans('aLogs.adm_cat_updated'),
            [
                'user'      => Auth::user()->id,
                'request'   => $request->all()
            ]);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {
        Log::log('INFO', trans('aLogs.adm_updated_delete'),
            [
                'user'      => Auth::user()->id,
            ]);
        RaffleCategory::destroy($id);
        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully');
    }
}