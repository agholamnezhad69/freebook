<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected  $table="tbl_company";
    public  $timestamps=false;
    protected  $fillable=['title','cat_id'];
}
