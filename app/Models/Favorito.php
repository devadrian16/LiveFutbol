<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = "favoritos";

    /**
    * The primary key associated with the table.
    *
    * @var string
    */
    protected $primaryKey = 'id_favorito';

    /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_user',
        'id_league',
        'id_team',
        'fecha'
    ];

    use HasFactory;
}
