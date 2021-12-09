<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'price',
        'description',
        'categories_id',
        'tags',
    ];

    public function galleries()
    {
        $this->hasMany(ProductGallery::class, 'products_id', 'id');
    }

    public function category()
    {
        $this->belongsTo(ProductCategory::class, 'categories_id', 'id');
    }
}
