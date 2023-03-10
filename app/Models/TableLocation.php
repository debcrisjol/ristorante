<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableLocation extends Model
{
    use HasFactory;
    protected $fillable = ['id','location'];



    public function tables()
    {
        return $this->hasMany(Table::class);
    }
}
