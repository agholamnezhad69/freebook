<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UniMajor extends Model
{
    protected  $table="tbl_uni_major";
    public  $timestamps=false;
    protected  $fillable=['uni_id','major_id'];
}
