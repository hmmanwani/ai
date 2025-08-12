<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;
    protected $table = 'holiday';
    // fetch the 
    // holiday data
    public static function getholidaylist($Data, $sort_field, $orderBy, $c)
    {
        $query = Holiday::query();
        if (!empty($Data['search']['value'])) {
            $query->where('holiday', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('date', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('h_id', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('weekday', "LIKE", "%{$Data['search']['value']}%");
        }
        $query->orderBy('h_id', $orderBy);
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
