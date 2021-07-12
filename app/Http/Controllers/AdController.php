<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class AdController extends Controller
{
    private static $category_ids = [];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page = 1)
    {
        $limit = 5;
        $offset = ($page * $limit) - $limit;
        $ads = Ad::all()->skip($offset)->take($limit);
        $count = Ad::all()->count();

        return view('admin.ads.show', [
            'ads' => $ads,
            'count' => $count,
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createView()
    {
        $categories = Category::all();
        return view('admin.ads.create', [
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

            'title' => 'bail|required|unique:ads|string|regex:/^[^@"<>$*€£`+=\/#]+$/', // ajouter bail pour message erreur de la 1ere erreur seulement   
            'description' => 'bail|required|string|regex:/^[^@"<>$*€£`+=\/#]+$/',
            'picture' => ['bail', 'required', 'string', 'regex:/(https?:\/\/).*/'],
            'price' => 'bail|required|numeric|gt:0',
            'location' => 'bail|required|string|regex:/^[^@"<>$*€£`+=\/#]+$/',
            'user_login' => 'bail|required|string|regex:/^[^@"<>$*€£`+=\/#]+$/',
        ]);

        $user_id = User::select('id')->where('login', $request->input('user_login'))->first();

        if ($user_id == null) {
            $categories = Category::all();
            return view('admin.ads.create', [
                'message' => 'User Name invalid',
                'categories' => $categories
            ]);
        }

        Ad::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'picture' => $request->input('picture'),
            'price' => $request->input('price'),
            'location' => $request->input('location'),
            'user_id' => $user_id->id,
        ]);

        $category_ids = $this->getParentCategoriesRecursive($request->input('category'));
        asort($category_ids);
        $ad = Ad::orderBy('id', 'DESC')->first();
        $ad->categories()->attach($category_ids);

        $message = 'The Ad has been succesfully created';
        $offset = (1 * 5) - 5;
        $ads = Ad::all()->skip($offset)->take(5);
        $count = Ad::all()->count();

        return view('admin.ads.show', [
            'ads' => $ads,
            'message' => $message,
            'count' => $count,
            'limit' => 5,
            'page' => 1,
        ]);
    }

    private function getParentCategoriesRecursive($category_id)
    {
        $category_parent = Category::select('parent_category')->where('id', $category_id)->first();
        // $category_ids = [];
        array_push(self::$category_ids, $category_id);
        if ($category_parent->parent_category !== null) {
            // array_push(self::$category_ids, $category_parent->parent_category);
            $this->getParentCategoriesRecursive($category_parent->parent_category);
        }

        return self::$category_ids;
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ad = Ad::findOrFail($id);
        $user_login = User::select('login')->where('id', $ad->user_id)->first();
        $ad["user_login"] = $user_login->login;
        $categories = Category::all();

        return view('admin.ads.update', [
            'ad' => $ad,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ad = Ad::find($id);

        if ($request->input('title')) {
            $request->validate([

                'title' => 'bail|required|unique:ads|string|regex:/^[^@"<>$*€£`+=\/#]+$/', // ajouter bail pour message erreur de la 1ere erreur seulement   
            ]);

            $ad->title = $request->input('title');
        }
        if ($request->input('description')) {
            $request->validate([
               'description' => 'bail|required|string|regex:/^[^@"<>$*€£`+=\/#]+$/',
            ]);
            $ad->description = $request->input('description');
        }
        if ($request->input('picture')) {
            $request->validate([
                'picture' => ['bail', 'required', 'string', 'regex:/(https?:\/\/).*/'],
            ]);
            $ad->picture = $request->input('picture');
        }
        if ($request->input('price')) {
            $request->validate([
               'price' => 'bail|required|numeric|gt:0',
            ]);
            $ad->price = $request->input('price');
        }
        if ($request->input('location')) {
            $request->validate([
                'location' => 'bail|required|string|regex:/^[^@"<>$*€£`+=\/#]+$/',
            ]);
            $ad->location = $request->input('location');
        }
        if ($request->input('user_login')) {
            $request->validate([
                'user_login' => 'bail|required|string|regex:/^[^@"<>$*€£`+=\/#]+$/',
            ]);
            $user_id = User::select('id')->where('login', $request->input('user_login'))->first();

            if ($user_id == null) {
                return view('admin.ads.{{ id }}', [
                    'message' => 'User Name invalid',
                ]);
            }
            $ad->user_id = $user_id;
        }
        $result = $ad->save();

        if ($request->input('category') !== "null") {
            $ad->categories()->detach();
            $category_ids = $this->getParentCategoriesRecursive($request->input('category'));
            asort($category_ids);
            $ad->categories()->attach($category_ids);
        }

        $ads = Ad::all()->take(5);
        $count = Ad::all()->count();
        $message = $result ? 'The Ad has been succesfully updated' : 'We have encounter an error in the updating of the Ad';

        return view('admin.ads.show', [
            'message' => $message,
            'ads' => $ads,
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
        $ads = Ad::find($id);
        $result = $ads->delete();
        if ($result) {
            $message = 'The User has been succesfully delete';
        } else {
            $message = 'We have encounter an error in the deleting of the User';
        }

        $ads = Ad::all()->take(5);
        $count = Ad::all()->count();

        return view('admin.ads.show', [
            'message' => $message,
            'ads' => $ads,
            'count' => $count,
            'limit' => 5,
            'page' => 1,
        ]);
    }
}
