<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'del_flag'];
    public function scopeActive($query){
        return $query->where('del_flag',false);
    }

    public function softDelete(){
        if($this->del_flag){
            return false;
        }
        return $this->update(['del_flag' => true]);
    }

}
