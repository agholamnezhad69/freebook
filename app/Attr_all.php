<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attr_all extends Model
{
    protected  $table="tbl_attr_all";
    public  $timestamps=false;
    protected  $fillable=['title','cat_ids'];
}
