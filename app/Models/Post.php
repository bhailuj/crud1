<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;

    protected $fillable=['post_title',
                        'post_author',
                        'post_address',
                        'email',
                        'password',
                        'number',
                        'country',
                        'state',
                        'city',
                        'gender',
                        'image',
                        'hobby',
                    ];

}
