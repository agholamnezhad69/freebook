<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    protected  $table="tbl_major";
    public  $timestamps=false;
    protected  $fillable=['title'];
}
