<?php

namespace App;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{

public function nearby() {
      return $this->belongsTo('App\User', 'id');
    }
public function prettySent() {
      $sent = Carbon::parse($this->sent_at);
      $time = '';
      if ($sent->hour > 11) {
        $time = $sent->hour - 12 . ':' . sprintf('%02d', $sent->minute) . ' pm';
      }
      else {
        $time = $sent->hour . ':' . sprintf('%02d', $sent->minute) . ' am';
      }
      $pretty = $sent->month . '/' . $sent->day . '/' . $sent->year . ' ' . $time;
      return $pretty;
    }
}
