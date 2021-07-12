<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        $category = new Category;
        $category->name = "Art";
        $category->parent_category = null;
        $category->save();

        //2
        $category = new Category;
        $category->name = "Electronics";
        $category->parent_category = null;
        $category->save();

        //3
        $category = new Category;
        $category->name = "Entertainment";
        $category->parent_category = null;
        $category->save();

        //4
        $category = new Category;
        $category->name = "Fashion";
        $category->parent_category = null;
        $category->save();

        //5
        $category = new Category;
        $category->name = "Home";
        $category->parent_category = null;
        $category->save();

        //6
        $category = new Category;
        $category->name = "Others";
        $category->parent_category = null;
        $category->save();

        //7
        $category = new Category;
        $category->name = "Painting";
        $category->parent_category = 1;
        $category->save();

        //8
        $category = new Category;
        $category->name = "Sculpture";
        $category->parent_category = 1;
        $category->save();

        //9
        $category = new Category;
        $category->name = "Computers";
        $category->parent_category = 2;
        $category->save();

        //10
        $category = new Category;
        $category->name = "Smartphones";
        $category->parent_category = 2;
        $category->save();

        //11
        $category = new Category;
        $category->name = "Cameras";
        $category->parent_category = 2;
        $category->save();

        //12
        $category = new Category;
        $category->name = "Videos Games";
        $category->parent_category = 2;
        $category->save();

        //13
        $category = new Category;
        $category->name = "DVD-Films";
        $category->parent_category = 3;
        $category->save();

        //14
        $category = new Category;
        $category->name = "Music";
        $category->parent_category = 3;
        $category->save();

        //15
        $category = new Category;
        $category->name = "Book";
        $category->parent_category = 3;
        $category->save();

        //16
        $category = new Category;
        $category->name = "Sport and Hobbies";
        $category->parent_category = 3;
        $category->save();

        //17
        $category = new Category;
        $category->name = "Clothes";
        $category->parent_category = 4;
        $category->save();

        //18
        $category = new Category;
        $category->name = "Shoes";
        $category->parent_category = 4;
        $category->save();

        //19
        $category = new Category;
        $category->name = "Accessories";
        $category->parent_category = 4;
        $category->save();

        //20
        $category = new Category;
        $category->name = "Watch";
        $category->parent_category = 4;
        $category->save();

        //21
        $category = new Category;
        $category->name = "Jewelry";
        $category->parent_category = 4;
        $category->save();

        //22
        $category = new Category;
        $category->name = "Baby";
        $category->parent_category = 4;
        $category->save();

        //23
        $category = new Category;
        $category->name = "furniture";
        $category->parent_category = 5;
        $category->save();

        //24
        $category = new Category;
        $category->name = "Home Appliance";
        $category->parent_category = 5;
        $category->save();

        //25
        $category = new Category;
        $category->name = "Decoration";
        $category->parent_category = 5;
        $category->save();

        //26
        $category = new Category;
        $category->name = "Garden";
        $category->parent_category = 5;
        $category->save();

        //27
        $category = new Category;
        $category->name = "Food and Wine";
        $category->parent_category = 6;
        $category->save();
    }
}
