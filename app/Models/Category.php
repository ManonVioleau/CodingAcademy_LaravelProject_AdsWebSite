<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Ad;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'parent_category',
    ];

    public function ads()
    {
        return $this->belongsToMany(Ad::class);
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Category', 'parent_category');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Category', 'parent_category');
    }

    // recursive, loads all descendants
    public function recursiveChildren()
    {
        return $this->children()->with('recursiveChildren');
    }

    // recursive, loads all parents
    public function recursiveParent()
    {
        return $this->parent()->with('recursiveParent');
    }

    //display all parents categories
    public function getParentsNames()
    {
        if ($this->parent) {
            if ($this->parent->getParentsNames() !== false) {
                return $this->parent->getParentsNames() . " > " . $this->parent->name;
            } else {
                return $this->parent->name;
            }
        } else {
            return false;
        }
    }

    //display category and all parent categories
    public function getCategoriesNames()
    {
        if ($this->parent) {
            return $this->parent->getParentsNames() . " > " . $this->name;
        } else {
            return $this->name;
        }
    }
}
