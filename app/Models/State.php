<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'mst_states';
    protected $primaryKey = 'stateId';
    public $timestamps = false; // if not using timestamps
}
