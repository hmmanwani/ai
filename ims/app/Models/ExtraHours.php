<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraHours extends Model
{
    use HasFactory;
    protected $table = 'extra_hours';

    public static function getextratimelist($Data, $sort_field, $orderBy, $c)
    {
        $empLogin = session('emp_login');
        $e_id = $empLogin['e_id'];
        $query = ExtraHours::query();
        if (!empty($Data['search']['value'])) {
            $query->where('ex_id', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('starting_time', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('ending_time', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('status', "LIKE", "%{$Data['search']['value']}%");
        }
        $query->where('extra_hours.e_id', $e_id);
        $query->orderBy('ex_id', $orderBy);
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
    // get approve extra time
    public static function getApproveExtraTimeAdmin($Data, $sort_field, $orderBy, $c)
    {
        $query = ExtraHours::query();
        if (!empty($Data['search']['value'])) {
            $query->where('ex_id', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('em.fname', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('em.lname', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('starting_time', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('ending_time', "LIKE", "%{$Data['search']['value']}%");
        }
        $query->select('extra_hours.*', 'extra_hours.ex_id', 'em.fname', 'em.lname', 'extra_hours.starting_time', 'extra_hours.ending_time', 'extra_hours.working_hour', 'extra_hours.status', 'extra_hours.e_id');
        $query->join('employee as em', 'em.e_id', '=', 'extra_hours.e_id');
        $query->where('extra_hours.status', 'Pending');
        $query->orderBy('ex_id', $orderBy);
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