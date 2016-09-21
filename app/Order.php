<?php

namespace App;

use Carbon\Carbon;
use App\Assignment;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $fillable = [
        'title',
        'description',
        'type',
        'contact',
        'priority',
        'notes',
        'location_id',
        'user_id',
        'entry',
        'exit',
        'close_key'
    ];

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->toDayDateTimeString();
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->toDayDateTimeString();
    }

    ////////////////////  Relationships //////////////////

    public function assignments()
    {
        return $this->hasMany('App\Assignment');
    }

    public function groupedAssignments()
    {
        return $this->hasMany(Assignment::class)->groupBy('status');
    }

    public function materials()
    {
        return $this->belongsToMany('App\Material')->withPivot('quantity')->withTimestamps();
    }

    public function costs()
    {
        return $this->hasMany('App\Cost');
    }

    public function bills()
    {
        return $this->hasMany('App\Bill');
    }

//    public function workers()
//    {
//        return $this->belongsToMany('App\Worker')->withPivot(['assignment'])->withTimestamps();
//    }

    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function isSeenBy(User $user, $snippet = null)
    {
        dd($this->location);
        switch ($snippet) {
            case null:
                return $user->owns($this) ||

                //SuperVisor|Manager
                $user->manage($this.location);
                $user->id === $this->location->manager_id ||

                //Same Auth selected Location
                $user->location_id === $this->location->id;

                //Area Manager//Regional Manager//Location Admin//Super Admin
                break;

            case 'details':
                return false;
                break;

            case 'assignments':
                return true;
                break;

            case 'costs':
                return true;
                break;
        }
    }
}
