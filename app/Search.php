<?php

namespace App;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
public function nearby() {
      return $this->belongsTo('App\User', 'id');
    }
}
