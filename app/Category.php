<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected  $table="tbl_state_uni";
    public  $timestamps=false;
    protected  $fillable=['title','parent_id'];
}
