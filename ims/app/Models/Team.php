<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{


    use HasFactory;
    protected $table = 'teams';

    public static function getteamlist($Data, $sort_field, $orderBy, $c)
    {
        $query = Team::query();
        if (!empty($Data['search']['value'])) {
            $query->where('t_id', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('team', "LIKE", "%{$Data['search']['value']}%");
        }
        $query->orderBy('t_id', $orderBy);
        if ($c == 1) {
            if ($Data['length'] != -1) {
                $query->offset($Data['start']);
                $query->limit($Data['length']);
            }
            return $query->get();
        } else {
            $result['NumRecords'] = $query->count();
            return $result;
        }
    }
}
