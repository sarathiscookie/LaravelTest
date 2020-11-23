<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
    * Get the matching company
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
