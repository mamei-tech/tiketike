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


class CategoriesController extends Controller
{
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
        RaffleCategory::create($request->all());
        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully');

    }

    public function update(Request $request, $category)
    {
        var_dump($request->all());
        die();
    }

    public function delete($id)
    {

    }

}