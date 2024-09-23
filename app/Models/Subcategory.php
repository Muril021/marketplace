<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
  use HasFactory;

  protected $table = 'subcategories';

  public function category()
  {
    return $this->belongsTo(Category::class, 'category_id');
  }

  public function microcategories()
  {
    return $this->hasMany(Microcategory::class, 'subcategory_id');
  }

  protected static function boot()
  {
    parent::boot();

    static::deleting(function ($subcategory) {
      $subcategory->microcategories()->delete();
    });
  }
}
