<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $table = 'sizes';
    public $primary_key = 'id';
    public $tamestamps = true;

    protected $fillable = [
        'width_single',
        'height_single',
        'width_list',
        'height_list',
        'updated_at',
    ];
}
