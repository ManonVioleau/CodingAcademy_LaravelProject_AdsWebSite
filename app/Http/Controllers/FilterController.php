<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class FilterController extends Controller
{
    /**
     * Filter the product display in the home page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $selectcategory = null;
        $selectcity = null;
        $ads = Ad::all();
        $message = null;
        $limit = 10;
        $count = count($ads);
        $ads = $ads->take(10);

        $categories = Category::all();

        $cities = Ad::select('location')->distinct()->get();

        $validator = Validator::make($request->all(), [
            'searchbar' => 'bail|nullable|string|regex:/^[^@"<>$*€£`+=\/#]+$/',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                        ->withErrors($validator)
                        ->withInput(['selectcategory' => $selectcategory,
                        'categories' => $categories,
                        'ads' => $ads,
                        'count' => $count,
                        'limit' => $limit,
                        'page' => 1,
                        'cities' => $cities,
                        'message' => $message,
                        'selectcity' => $selectcity,]);
        }


        if ($request->input('searchbar') !== "null") {
            $search_product = Ad::where('title', 'like', '%' . $request->input('searchbar') . '%')->exists();
            $search_category = Category::where('name', 'like', '%' . $request->input('searchbar') . '%')->exists();

            if ($search_category) {
                $categories_search = Category::where('name', 'like', '%' . $request->input('searchbar') . '%')->get();
                $ads = collect([]);

                if ($request->input('location')) {
                    $selectcity = $request->input('location');
                    if ($request->input('category')) {
                        $selectcategory = $request->input('category');
                        foreach ($categories_search as $category) {
                            if ($category->name == $request->input('category')) {
                                foreach ($category->ads as $ad) {
                                    if ($ad->location == $request->input('location')) {
                                        $ads->push($ad);
                                    }
                                }
                            }
                        }
                    } else {
                        foreach ($categories_search as $category) {
                            foreach ($category->ads as $ad) {
                                if ($ad->location == $request->input('location')) {
                                    $ads->push($ad);
                                }
                            }
                        }
                    }
                } elseif ($request->input('category')) {
                    $selectcategory = $request->input('category');
                    foreach ($categories_search as $category) {
                        if ($category->name == $request->input('category')) {
                            foreach ($category->ads as $ad) {
                                $ads->push($ad);
                            }
                        }
                    }
                } else {
                    foreach ($categories_search as $category) {
                        foreach ($category->ads as $ad) {
                            $ads->push($ad);
                        }
                    }
                }
            } elseif (!$search_product) {
                $message = 'Sorry, we were unable to found what you are searching for.';
            }

            if ($search_product) {
                if ($request->input('location')) {
                    $selectcity = $request->input('location');
                    if ($request->input('category')) {
                        $selectcategory = $request->input('category');
                        $category = Category::where('name', $request->input('category'))->first();
                        $ads = collect([]);
                        $ads_filter = Ad::where('title', 'like', '%' . $request->input('searchbar') . '%')->where('location', $request->input('location'))->get();
                        foreach ($category->ads as $ad) {
                            foreach ($ads_filter as $ad_filter) {
                                if ($ad->title == $ad_filter->title) {
                                    $ads->push($ad);
                                }
                            }
                        }
                    } else {
                        $ads = Ad::where('title', 'like', '%' . $request->input('searchbar') . '%')->where('location', $request->input('location'))->get();
                    }
                } elseif ($request->input('category')) {
                    $selectcategory = $request->input('category');
                    $category = Category::where('name', $request->input('category'))->first();
                    $ads = collect([]);
                    $ads_filter = Ad::where('title', 'like', '%' . $request->input('searchbar') . '%')->get();
                    foreach ($category->ads as $ad) {
                        foreach ($ads_filter as $ad_filter) {
                            if ($ad->title == $ad_filter->title) {
                                $ads->push($ad);
                            }
                        }
                    }
                } else {
                    $ads = Ad::where('title', 'like', '%' . $request->input('searchbar') . '%')->get();
                }
            } elseif (!$search_category) {
                $message = 'Sorry, we were unable to found what you are searching for.';
            }
        } elseif ($request->input('location')) {
            $selectcity = $request->input('location');
            if ($request->input('category')) {
                $selectcategory = $request->input('category');
                $category = Category::where('name', $request->input('category'))->first();
                $ads = collect([]);
                foreach ($category->ads as $ad) {
                    if ($ad->location == $request->input('location')) {
                        $ads->push($ad);
                    }
                }
            } else {
                $ads = Ad::where('location', $request->input('location'))->get();
            }
        } elseif ($request->input('category')) {
            $selectcategory = $request->input('category');
            $category = Category::where('name', $request->input('category'))->first();
            $ads = collect([]);
            foreach ($category->ads as $ad) {
                $ads->push($ad);
            }
        } else {
            $message = 'Sorry, we were unable to found what you are searching for.';
        }


        $count = count($ads);
        $ads = $ads->take(10);

        return view('index', [
            'selectcategory' => $selectcategory,
            'categories' => $categories,
            'ads' => $ads,
            'count' => $count,
            'limit' => $limit,
            'page' => 1,
            'cities' => $cities,
            'message' => $message,
            'selectcity' => $selectcity,
        ]);
    }
}
