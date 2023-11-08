<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','category','price','qty','description','image1','image2'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
