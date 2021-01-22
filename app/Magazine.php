<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use App\Author;

class Magazine extends Model
{
    protected $table = 'magazines';
    protected $guarded = [ ];
    protected $dates = [ 'issue_date' ];
    public $primaryKey = 'magazine_id';
    public $timestamps = false; 
    
    public function authors()
    {
        return $this->belongsToMany('App\Author', 'author_magazine', 'magazine_id', 'author_id');
    }
}
