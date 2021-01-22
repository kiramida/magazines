<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'authors';
    protected $guarded = [ ];
    public $primaryKey = 'author_id';
    public $timestamps = false; 
    
    public function magazines()
    {
        return $this->belongsToMany('App\Magazine', 'author_magazine', 'author_id', 'magazine_id');
    }
}
