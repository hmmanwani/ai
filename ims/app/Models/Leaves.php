<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DateTime;

class Leaves extends Model
{
    use HasFactory;
    protected $table = 'leaves';
    protected $fillable = ['lt_id', 'status'];
    public static function generateUniqueIdentifier()
    {
        $identifier = Str::random(10);
        if (self::where('l_identity', $identifier)->exists()) {
            return self::generateUniqueIdentifier();
        }
        return $identifier;
    }
    // leave list
    public static function getLeavelist($Data, $sort_field, $orderBy, $c)
    {
        $query = Leaves::query();
        if (!empty($Data['search']['value'])) {
            // $query->where('lv_id', "LIKE", "%{$Data['search']['value']}%")
            //     ->orWhere('leave_for', "LIKE", "%{$Data['search']['value']}%")
            //     ->orWhere('leave_responsible_person', "LIKE", "%{$Data['search']['value']}%")
            //     ->orWhere('leave_date', "LIKE", "%{$Data['search']['value']}%");
        }
        if (!empty($Data['filters']['l_type'])) {
            if ($Data['filters']['l_type'] != 'all') {
                $query->where('leaves.leave_type', $Data['filters']['l_type']);
            }
        }
        if (!empty($Data['filters']['s_date'])) {
            $s_date = date("Y-m-d", strtotime($Data['filters']['s_date']));
            $query->where('leaves.leave_date', '>=', $s_date);
        }
        if (!empty($Data['filters']['e_date'])) {
            $e_date = date("Y-m-d", strtotime($Data['filters']['e_date']));
            $query->where('leaves.leave_date', '<=', $e_date);
        }
        if (!empty($Data['filters']['s_date']) && !empty($Data['filters']['e_date'])) {
            $query->whereBetween('leaves.leave_date', [$s_date, $e_date]);
        }
        $query->select('leaves.*', 'lt.lt_id', 'lt.leave_type as leaveName', 'em.fname as r_fname', 'em.lname as r_lname');
        $query->join('leaves_type as lt', 'lt.lt_id', '=', 'leaves.leave_type');
        $query->join('employee as em', 'em.e_id', '=', 'leaves.leave_responsible_person');
        $query->where('leaves.e_id', $Data['filters']['e_id']);
        $query->where('leaves.is_display', 1);
        $query->orderBy('leave_date', $orderBy);
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
    // pending leave on admin side.
    public static function getPendingLeaveAdmin($Data, $sort_field, $orderBy, $c)
    {
        $query = Leaves::query();
        if (!empty($Data['search']['value'])) {
            $query->where('lv_id', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('leave_for', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('leave_date', "LIKE", "%{$Data['search']['value']}%");
        }
        $query->select('leaves.*', 'lt.lt_id', 'lt.leave_type as leaveName', 'em.fname as r_fname', 'em.lname as r_lname', 'e.fname as e_fname', 'e.lname as e_lname', 'leaves.e_id');
        $query->join('leaves_type as lt', 'lt.lt_id', '=', 'leaves.leave_type');
        $query->join('employee as em', 'em.e_id', '=', 'leaves.leave_responsible_person');
        $query->join('employee as e', 'e.e_id', '=', 'leaves.e_id');
        if ($Data['filters']['e_id'] != 'all') {
            $query->where('leaves.e_id', $Data['filters']['e_id']);
        }
        $query->where('leaves.status', 'Pending');
        $query->where('leaves.is_display', 1);
        $query->orderBy($sort_field, $orderBy);
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
    // Approve leave on admin side
    public static function getApprovedLeaveAdmin($Data, $sort_field, $orderBy, $c)
    {
        $query = Leaves::query();
        if (!empty($Data['search']['value'])) {
            $query->where('lv_id', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('leave_for', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('leave_date', "LIKE", "%{$Data['search']['value']}%");
        }
        $query->select('leaves.*', 'lt.lt_id', 'lt.leave_type as leaveName', 'em.fname as r_fname', 'em.lname as r_lname', 'e.fname as e_fname', 'e.lname as e_lname');
        $query->join('leaves_type as lt', 'lt.lt_id', '=', 'leaves.leave_type');
        $query->join('employee as em', 'em.e_id', '=', 'leaves.leave_responsible_person');
        $query->join('employee as e', 'e.e_id', '=', 'leaves.e_id');
        if ($Data['filters']['e_id'] != 'all') {
            $query->where('leaves.e_id', $Data['filters']['e_id']);
        }
         if (!empty($Data['filters']['l_date'])) {
            $query->where('leave_date',"=" ,(DateTime::createFromFormat('d-m-Y', $Data['filters']['l_date']))->format('Y-m-d'));
        }
        $query->whereIn('leaves.status', ['Approve', 'Reject']);
        $query->orderBy('leave_date', $orderBy);
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
    public static function leaveDetails($id)
    {
        $query = Leaves::query();
        $query->select('leaves.*', 'lt.lt_id', 'lt.leave_type as leaveName', 'em.fname as r_fname', 'em.lname as r_lname', 'e.fname as e_fname', 'e.lname as e_lname');
        $query->join('leaves_type as lt', 'lt.lt_id', '=', 'leaves.leave_type');
        $query->join('employee as em', 'em.e_id', '=', 'leaves.leave_responsible_person');
        $query->join('employee as e', 'e.e_id', '=', 'leaves.e_id');
        $query->where('leaves.lv_id', $id);
        return $query->get();
    }
}
