<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use App\Models\Leaves;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;
    protected $table = 'leaves_type';
    protected $fillable = ['leave_type', 'total_leaves'];

    public static function getleavetypelist($Data, $sort_field, $orderBy, $c)
    {
        $query = LeaveType::query();
        if (!empty($Data['search']['value'])) {
            $query->where('lt_id', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('leave_type', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('total_leave', "LIKE", "%{$Data['search']['value']}%");
        }
        $query->orderBy('lt_id', $orderBy);
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