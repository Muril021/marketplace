<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  use HasFactory;

  protected $table = 'categories';

  public function subcategories()
  {
    return $this->hasMany(Subcategory::class, 'category_id');
  }

  public function microcategories()
  {
    return $this->hasMany(Microcategory::class, 'category_id');
  }

  protected static function boot()
  {
    parent::boot();

    static::deleting(function ($category) {
      $category->subcategories()->delete();
      $category->microcategories()->delete();
    });
  }
}
