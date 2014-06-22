<?php

class Music extends Eloquent
{
    protected $table      = 'music';
    protected $fillable   = array('url', 'formato');
    protected $guarded    = array('id');
    public    $timestamps = false;

 public static function ventasPorVendedor()
    {
        return DB::select("select * from music");
    }
}
