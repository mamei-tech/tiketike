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
        return view('admin.categories', [
            'div_showRaffles' => 'show',
            'li_activeRCategories' => 'active',
        ]);
    }

    public function store(Request $request)
    {

    }

    public function update(Request $request, $category)
    {

    }

    public function delete($id)
    {

    }

}