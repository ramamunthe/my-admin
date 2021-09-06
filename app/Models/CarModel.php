<?php

namespace App\Models;

use CodeIgniter\Model;

class CarModel extends Model
{
    protected $table      = 'car';
    protected $primaryKey = 'car_id';

    protected $allowedFields = [
        'category_id', 
        'slug_car', 
        'title_car', 
        'body_car', 
        'image'
    ];
}