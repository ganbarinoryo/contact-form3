<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'first_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
        'category_id'
    ];

    public function getGenderAttribute($value)
    {
        $gender_mapping = [
            1 => '男性',
            2 => '女性',
            3 => 'その他'
        ];
        return $gender_mapping[$value] ?? 'その他';
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}