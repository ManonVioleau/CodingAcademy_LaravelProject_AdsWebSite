<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB;
use App\Models\Ad;
use App\Models\User;

class AdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        $ad = new Ad;
        $ad->description = "une description";
        $ad->price = random_int(10, 500);
        $ad->location = "New-York";
        $ad->user_id = User::all()->random()->id;
        $ad->title = "laptop asus";
        $ad->picture = "https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1052&q=80";
        $ad->save();
        $category_ids = [2, 9];
        $ad->categories()->attach($category_ids);

        //2
        $ad = new Ad;
        $ad->description = "une description";
        $ad->price = random_int(10, 500);
        $ad->location = "Los Angeles";
        $ad->user_id = User::all()->random()->id;
        $ad->title = "computer mac";
        $ad->picture = "https://images.unsplash.com/photo-1494173853739-c21f58b16055?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=701&q=80";
        $ad->save();
        $category_ids = [2, 9];
        $ad->categories()->attach($category_ids);

        //3
        $ad = new Ad;
        $ad->description = "une description";
        $ad->price = random_int(10, 500);
        $ad->location = "San Francisco";
        $ad->user_id = User::all()->random()->id;
        $ad->title = "iphone 7";
        $ad->picture = "https://images.unsplash.com/photo-1524466302651-a98b8b02c497?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1064&q=80";
        $ad->save();
        $category_ids = [2, 10];
        $ad->categories()->attach($category_ids);

        //4
        $ad = new Ad;
        $ad->description = "une description";
        $ad->price = random_int(10, 500);
        $ad->location = "Chicago";
        $ad->user_id = User::all()->random()->id;
        $ad->title = "android";
        $ad->picture = "https://images.unsplash.com/photo-1600087626014-e652e18bbff2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=700&q=80";
        $ad->save();
        $category_ids = [2, 10];
        $ad->categories()->attach($category_ids);

        //5
        $ad = new Ad;
        $ad->description = "une description";
        $ad->price = random_int(10, 500);
        $ad->location = "Miami";
        $ad->user_id = User::all()->random()->id;
        $ad->title = "full set of dvd";
        $ad->picture = "https://images.unsplash.com/photo-1513035097-b6ddae614caa?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=675&q=80";
        $ad->save();
        $category_ids = [3, 13];
        $ad->categories()->attach($category_ids);

        //6
        $ad = new Ad;
        $ad->description = "une description";
        $ad->price = random_int(10, 500);
        $ad->location = "Washington";
        $ad->user_id = User::all()->random()->id;
        $ad->title = "milk and honey";
        $ad->picture = "https://images.unsplash.com/photo-1544947950-fa07a98d237f?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTV8fGJvb2t8ZW58MHx8MHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60";
        $ad->save();
        $category_ids = [3, 15];
        $ad->categories()->attach($category_ids);

        //7
        $ad = new Ad;
        $ad->description = "une description";
        $ad->price = random_int(10, 500);
        $ad->location = "Seattle";
        $ad->user_id = User::all()->random()->id;
        $ad->title = "multiple books";
        $ad->picture = "https://images.unsplash.com/photo-1512820790803-83ca734da794?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTd8fGJvb2t8ZW58MHx8MHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60";
        $ad->save();
        $category_ids = [3, 15];
        $ad->categories()->attach($category_ids);

        //8
        $ad = new Ad;
        $ad->description = "une description";
        $ad->price = random_int(10, 500);
        $ad->location = "Boston";
        $ad->user_id = User::all()->random()->id;
        $ad->title = "tennis racket";
        $ad->picture = "https://images.unsplash.com/photo-1512412046876-f386342eddb3?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MjZ8fHNwb3J0fGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60";
        $ad->save();
        $category_ids = [3, 16];
        $ad->categories()->attach($category_ids);

        //9
        $ad = new Ad;
        $ad->description = "une description";
        $ad->price = random_int(10, 500);
        $ad->location = "New Orleans";
        $ad->user_id = User::all()->random()->id;
        $ad->title = "jackets";
        $ad->picture = "https://images.unsplash.com/photo-1551232864-3f0890e580d9?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80";
        $ad->save();
        $category_ids = [4, 17];
        $ad->categories()->attach($category_ids);

        //10
        $ad = new Ad;
        $ad->description = "une description";
        $ad->price = random_int(10, 500);
        $ad->location = "San Diego";
        $ad->user_id = User::all()->random()->id;
        $ad->title = "white shirt";
        $ad->picture = "https://images.unsplash.com/photo-1554568218-0f1715e72254?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=634&q=80";
        $ad->save();
        $category_ids = [4, 17];
        $ad->categories()->attach($category_ids);

        //11
        $ad = new Ad;
        $ad->description = "une description";
        $ad->price = random_int(10, 500);
        $ad->location = "Philadelphie";
        $ad->user_id = User::all()->random()->id;
        $ad->title = "grey shirt";
        $ad->picture = "https://images.unsplash.com/photo-1564584217132-2271feaeb3c5?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80";
        $ad->save();
        $category_ids = [4, 17];
        $ad->categories()->attach($category_ids);

        //12
        $ad = new Ad;
        $ad->description = "une description";
        $ad->price = random_int(10, 500);
        $ad->location = "Las Vegas";
        $ad->user_id = User::all()->random()->id;
        $ad->title = "jacket";
        $ad->picture = "https://images.unsplash.com/photo-1543076447-215ad9ba6923?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=967&q=80";
        $ad->save();
        $category_ids = [4, 17];
        $ad->categories()->attach($category_ids);

        //13
        $ad = new Ad;
        $ad->description = "une description";
        $ad->price = random_int(10, 500);
        $ad->location = "Houston";
        $ad->user_id = User::all()->random()->id;
        $ad->title = "converse";
        $ad->picture = "https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=643&q=80";
        $ad->save();
        $category_ids = [4, 18];
        $ad->categories()->attach($category_ids);

        //14
        $ad = new Ad;
        $ad->description = "une description";
        $ad->price = random_int(10, 500);
        $ad->location = "New-York";
        $ad->user_id = User::all()->random()->id;
        $ad->title = "pump";
        $ad->picture = "https://images.unsplash.com/photo-1543163521-1bf539c55dd2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80";
        $ad->save();
        $category_ids = [4, 18];
        $ad->categories()->attach($category_ids);

        //15
        $ad = new Ad;
        $ad->description = "une description";
        $ad->price = random_int(10, 500);
        $ad->location = "Los Angeles";
        $ad->user_id = User::all()->random()->id;
        $ad->title = "nike";
        $ad->picture = "https://images.unsplash.com/photo-1491553895911-0055eca6402d?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80";
        $ad->save();
        $category_ids = [4, 18];
        $ad->categories()->attach($category_ids);

        //16
        $ad = new Ad;
        $ad->description = "une description";
        $ad->price = random_int(10, 500);
        $ad->location = "San Francisco";
        $ad->user_id = User::all()->random()->id;
        $ad->title = "chair";
        $ad->picture = "https://images.unsplash.com/photo-1598300042247-d088f8ab3a91?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8ZnVybml0dXJlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60";
        $ad->save();
        $category_ids = [5, 23];
        $ad->categories()->attach($category_ids);

        //17
        $ad = new Ad;
        $ad->description = "une description";
        $ad->price = random_int(10, 500);
        $ad->location = "Chicago";
        $ad->user_id = User::all()->random()->id;
        $ad->title = "couch";
        $ad->picture = "https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8ZnVybml0dXJlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60";
        $ad->save();
        $category_ids = [5, 23];
        $ad->categories()->attach($category_ids);

        //18
        $ad = new Ad;
        $ad->description = "une description";
        $ad->price = random_int(10, 500);
        $ad->location = "Miami";
        $ad->user_id = User::all()->random()->id;
        $ad->title = "painting";
        $ad->picture = "https://images.unsplash.com/photo-1604757910263-bdf361745bed?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NXx8ZGVjb3JhdGlvbnxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60";
        $ad->save();
        $category_ids = [5, 25];
        $ad->categories()->attach($category_ids);

        //19
        $ad = new Ad;
        $ad->description = "une description";
        $ad->price = random_int(10, 500);
        $ad->location = "Washington";
        $ad->user_id = User::all()->random()->id;
        $ad->title = "red wine";
        $ad->picture = "https://images.unsplash.com/photo-1519092796169-bb9cc75a4b68?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MzJ8fHdpbmV8ZW58MHx8MHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60";
        $ad->save();
        $category_ids = [6, 27];
        $ad->categories()->attach($category_ids);

        //20
        $ad = new Ad;
        $ad->description = "une description";
        $ad->price = random_int(10, 500);
        $ad->location = "Seattle";
        $ad->user_id = User::all()->random()->id;
        $ad->title = "truffle";
        $ad->picture = "https://images.unsplash.com/photo-1601170022270-39cac948bfdc?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8dHJ1ZmZsZXxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60";
        $ad->save();
        $category_ids = [6, 27];
        $ad->categories()->attach($category_ids);

        //21
        $ad = new Ad;
        $ad->description = "une description";
        $ad->price = random_int(10, 500);
        $ad->location = "Seattle";
        $ad->user_id = User::all()->random()->id;
        $ad->title = "iphone X";
        $ad->picture = "https://images.unsplash.com/photo-1537589376225-5405c60a5bd8?ixid=MnwxMjA3fDB8MHxzZWFyY2h8OHx8aXBob25lfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60";
        $ad->save();
        $category_ids = [2, 10];
        $ad->categories()->attach($category_ids);

        //22
        $ad = new Ad;
        $ad->description = "une description";
        $ad->price = random_int(10, 500);
        $ad->location = "San Francisco";
        $ad->user_id = User::all()->random()->id;
        $ad->title = "macbook pro";
        $ad->picture = "https://images.unsplash.com/photo-1496181133206-80ce9b88a853?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8Y29tcHV0ZXJ8ZW58MHx8MHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60";
        $ad->save();
        $category_ids = [2, 9];
        $ad->categories()->attach($category_ids);
    }
}
