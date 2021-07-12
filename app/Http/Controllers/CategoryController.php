<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = 5;
        $categories = Category::all()->take($limit);
        $count = Category::all()->count();

        return view('admin.categories.show', [
            'categories' => $categories,
            'count' => $count,
            'limit' => $limit,
            'page' => 1,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'bail|required|unique:categories|string|regex:/^[^@"<>$*€£`+=\/#]+$/', // ajouter bail pour message erreur de la 1ere erreur seulement   
            'category_parent' => 'bail|nullable',
        ]);

        if ($request->input('category_parent') == "null") {
            $parent_category = null;
        } else {
            $parent_category = $request->input('category_parent');
        }

        Category::create([
            'name' => $request->input('name'),
            'parent_category' => $parent_category,
        ]);

        $message = 'The Category has been succesfully created';
        $limit = 5;
        $categories = Category::all()->take($limit);
        $count = Category::all()->count();

        return view('admin.categories.show', [
            'categories' => $categories,
            'message' => $message,
            'count' => $count,
            'limit' => $limit,
            'page' => 1,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($page = 1)
    {
        $limit = 5;
        $offset = ($page * $limit) - $limit;
        $categories = Category::all()->skip($offset)->take($limit);
        $count = Category::all()->count();

        return view('admin.categories.show', [
            'categories' => $categories,
            'count' => $count,
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::all();

        return view('admin.categories.update', [
            'category' => $category,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if ($request->input('name')) {
            $request->validate([

                'name' => 'bail|required|unique:categories|string|regex:/^[^@"<>$*€£`+=\/#]+$/', // ajouter bail pour message erreur de la 1ere erreur seulement   
            ]);

            $category->name = $request->input('name');
        }
        if ($request->input('parent_category') !== "null") {
            $category->parent_category = $request->input('parent_category');
        }

        $result = $category->save();

        $categories = Category::all()->take(5);
        $count = Category::all()->count();
        $message = $result ? 'The Category has been succesfully updated' : 'We have encounter an error in the updating of the Category';

        return view('admin.categories.show', [
            'message' => $message,
            'categories' => $categories,
            'count' => $count,
            'limit' => 5,
            'page' => 1,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->delete;
        $category = Category::find($id);
        $result = $category->delete();
        if ($result) {
            $message = 'The Category has been succesfully delete';
        } else {
            $message = 'We have encounter an error in the deleting of the Category';
        }

        $categories = Category::all()->take(5);
        $count = Category::all()->count();

        return view('admin.categories.show', [
            'message' => $message,
            'categories' => $categories,
            'count' => $count,
            'limit' => 5,
            'page' => 1,
        ]);
    }
}
