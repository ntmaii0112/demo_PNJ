<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable =
        [
            'name',
            'originalPrice',
            'salePrice',
            'image',
            'category_id',
            'quantity',
            'soldCount',
            'del_flag',
        ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function scopeActive($query){
        return $query->where('del_flag', false);
    }
    public function softDelete(){
        if($this->del_flag){
            return false;
        }
        return $this->update(['del_flag' => true]);
    }

}
