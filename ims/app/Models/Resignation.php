<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resignation extends Model
{
    use HasFactory;
    protected $table = 'resignation';

    public static function gethresignationslist($Data, $sort_field, $orderBy, $c)
    {
        $query = Resignation::query();
        if (!empty($Data['search']['value'])) {
            $query->where('reason', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('r_id', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('date', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('description', "LIKE", "%{$Data['search']['value']}%");
        }
        $query->select('resignation.*', 'em.fname', 'em.lname');
        $query->join('employee as em', 'em.e_id', '=', 'resignation.e_id');
        $query->orderBy('r_id', $orderBy);
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
