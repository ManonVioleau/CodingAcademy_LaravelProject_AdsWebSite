<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ad;
use App\Models\Category;
use App\Models\User;

// use App\Http\Controllers\AdController;

class IndexController extends Controller
{
    private static $category_ids = [];

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

    public function index($page = 1)
    {
        $limit = 10;
        $offset = ($page * $limit) - $limit;
        $ads = Ad::all()->skip($offset)->take($limit);
        // $ads = Ad::all();
        $count = Ad::all()->count();

        $categories = Category::all();

        $cities = Ad::select('location')->distinct()->get();

        return view('index', [
            'categories' => $categories,
            'ads' => $ads,
            'count' => $count,
            'limit' => $limit,
            'page' => $page,
            'cities' => $cities,
        ]);
    }

    public function displayad($ad_id)
    {
        $ad = Ad::where('id', $ad_id)->first();
        $user_id = Ad::select('user_id')->where('id', $ad_id)->first();
        $user = User::where('id', $user_id->user_id)->first();
        $nbad = AD::where('user_id', $user_id->user_id)->count();
        return view('ads.ad', [
            'ad' => $ad,
            'user' => $user,
            'nbad' => $nbad,
        ]);
    }

    public function displayuser($nickname)
    {
        $user = User::where('nickname', $nickname)->first();
        $ads_user = Ad::where('user_id', $user->id)->get();
        return view('user.user', [
            'user' => $user,
            'ads_user' => $ads_user,
        ]);
    }

    public function destroy($nickname, $id_ad)
    {

        $ad = Ad::find($id_ad);
        $result = $ad->delete();

        $user = User::where('nickname', $nickname)->first();
        $ads_user = Ad::where('user_id', $user->id)->get();

        if ($result) {
            $message = 'Your ad has been succesfully delete';
        } else {
            $message = 'We have encounter an error in the deleting of your ad';
        }

        return view('user.user', [
            'user' => $user,
            'ads_user' => $ads_user,
            'message' => $message,
        ]);
    }

    public function create($nickname)
    {
        $categories = Category::all();
        $user = User::where('nickname', $nickname)->first();

        return view('user.add', [
            'user' => $user,
            'categories' => $categories,
        ]);
    }
    public function store(Request $request, $nickname)
    {
        $request->validate([

            'title' => 'bail|required|unique:ads|string|regex:/^[^@"<>$*€£`+=\/#]+$/', // ajouter bail pour message erreur de la 1ere erreur seulement   
            'description' => 'bail|required|string|regex:/^[^@"<>$*€£`+=\/#]+$/',
            'picture' => ['bail', 'required', 'string', 'regex:/(https?:\/\/).*/'],
            'price' => 'bail|required|numeric|gt:0',
            'location' => 'bail|required|string|regex:/^[^@"<>$*€£`+=\/#]+$/',
        ]);
        // dd($nickname);
        $user_id = User::select('id')->where('nickname', $nickname)->first();

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

        $user = User::where('nickname', $nickname)->first();
        $ads_user = Ad::where('user_id', $user->id)->get();

        return view('user.user', [
            'user' => $user,
            'ads_user' => $ads_user,
            'message' => $message,
        ]);
    }

    public function edit($nickname, $ad_id)
    {
        $ad = Ad::findOrFail($ad_id);
        $categories = Category::all();
        $user = User::where('nickname', $nickname)->first();

        return view('user.update', [
            'ad' => $ad,
            'categories' => $categories,
            'user' => $user,
        ]);
    }

    public function update(Request $request, $nickname, $id)
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
        $result = $ad->save();

        if ($request->input('category') !== "null") {
            $ad->categories()->detach();
            $category_ids = $this->getParentCategoriesRecursive($request->input('category'));
            asort($category_ids);
            $ad->categories()->attach($category_ids);
        }

        $message = $result ? 'The Ad has been succesfully updated' : 'We have encounter an error in the updating of the Ad';

        $user = User::where('nickname', $nickname)->first();
        $ads_user = Ad::where('user_id', $user->id)->get();

        return view('user.user', [
            'user' => $user,
            'ads_user' => $ads_user,
            'message' => $message,
        ]);
    }

    public function profile($nickname) {
        $user = User::where('nickname', $nickname)->first();
        $nbad = Ad::where('user_id', $user->id)->count();
        $nbsell = random_int(1, 10);

        return view('user.profile', [
            'user' => $user,
            'nbad' => $nbad,
            'nbsell' => $nbsell,
        ]);
    }

    public function public($nickname) {
        $user = User::where('nickname', $nickname)->first();
        $ads = Ad::where('user_id', $user->id)->get();
        $nbad = Ad::where('user_id', $user->id)->count();
        $nbsell = random_int(1, 10);

        return view('user.public-profile', [
            'user' => $user,
            'nbad' => $nbad,
            'nbsell' => $nbsell,
            'ads' => $ads,
        ]);
    }

    public function edituser($nickname) {
        $user = User::where('nickname', $nickname)->first();

        return view('user.profile-update', [
            'user' => $user,
        ]);
    }

    public function updateuser(Request $request, $nickname) {

        $user = User::where('nickname', $nickname)->first();
        $login_exists = User::where('id', '!=', $user->id)->where('login', $request->input('login'))->first();
        $email_exists = User::where('id', '!=', $user->id)->where('email', $request->input('email'))->first();

        if (isset($login_exists)) {
            $message = 'The Login already exists';

            return view('user.profile-update', [
                'message' => $message,
                'user' => $user,
            ]);
        } elseif (isset($email_exists)) {
            $message = 'The Email already exists';
            return view('user.profile-update', [
                'message' => $message,
                'user' => $user,
            ]);
        } else {
            $user->login = $request->input('login');
            $user->email = $request->input('email');
            $user->phone_number = $request->input('phone_number');
            $user->nickname = $request->input('nickname');
            $result = $user->save();
            if ($result) {
                $message = 'The User has been succesfully updated';
            } else {
                $message = 'We have encounter an error in the updating of the User';
            }

            $ads = Ad::where('user_id', $user->id)->get();
            $nbad = Ad::where('user_id', $user->id)->count();
            $nbsell = random_int(1, 10);
    
            return view('user.private-profile', [
                'message' => $message,
                'user' => $user,
                'nbad' => $nbad,
                'nbsell' => $nbsell,
                'ads' => $ads,
            ]);
        }
    }

    public function privateprofile($nickname) {

        $user = User::where('nickname', $nickname)->first();
        $ads = Ad::where('user_id', $user->id)->get();
        $nbad = Ad::where('user_id', $user->id)->count();
        $nbsell = random_int(1, 10);

        return view('user.private-profile', [
            'user' => $user,
            'nbad' => $nbad,
            'nbsell' => $nbsell,
            'ads' => $ads,
        ]);
    }
}
