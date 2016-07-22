<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class ChildInfo extends Model
{
    protected $table="child_info";

    public function users()
    {
        return $this->hasOne(User::class,'id','users_id');
    }
}
