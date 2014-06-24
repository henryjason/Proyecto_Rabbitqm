<?php

class Music extends Eloquent
{
    protected $table      = 'music';
    protected $fillable   = array('url', 'formato', 'channel', 'status');
    protected $guarded    = array('id');
    public    $timestamps = false;

 public static function ejemplo()
    {
        return DB::select("select * from music");
    }


    

}
