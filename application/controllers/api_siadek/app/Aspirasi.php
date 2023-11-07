<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    protected $table = 'tbl_aspirasi';

    protected $fillable = [
    					
    						'kd_wilayah',
                           'nik',
                           'nama',
                           'keterangan'
                        ];

                        public $timestamps = false;
}