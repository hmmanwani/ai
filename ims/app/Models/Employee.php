<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Employee extends Model
{
    use HasFactory;
    protected $table = "employee";
    protected $primaryKey = 'e_id';

    public static function generateUniquerandomString()
    {
        $randomString = Str::random(10); // Generate a random string of 10 characters
        if (self::where('pass_token', $randomString)->exists()) {
            return self::generateUniquerandomString();
        }
        return $randomString;
    }
    public static function getEmployeeList($Data, $sort_field, $orderBy, $c)
    {
        $query = Employee::query();
        if (!empty($Data['search']['value'])) {
            $query->where('e_id', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('fname', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('lname', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('tm.team', "LIKE", "%{$Data['search']['value']}%");
        }
        if ($Data['filters']['status'] != 'all') {
            $query->where('employee.status', $Data['filters']['status']);
        }
        if ($Data['filters']['team'] != 'all') {
            $query->where('employee.team', $Data['filters']['team']);
        }
        $query->select('employee.*', 'tm.team as teamName');
        $query->join('teams as tm', 'tm.t_id', '=', 'employee.team');
        $query->orderBy('e_id', $orderBy);
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

    // to use notification
    public static function getempList($Data, $sort_field, $orderBy, $c)
    {
        $query = Employee::query();
        if (!empty($Data['search']['value'])) {
            $query->where('e_id', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('fname', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('lname', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('tm.team', "LIKE", "%{$Data['search']['value']}%");
        }
        if ($Data['filters']['status'] != 'all') {
            $query->where('employee.email_notification', $Data['filters']['status']);
        }
        if ($Data['filters']['team'] != 'all') {
            $query->where('employee.team', $Data['filters']['team']);
        }
        $query->select('employee.*', 'tm.team as teamName');
        $query->join('teams as tm', 'tm.t_id', '=', 'employee.team');
        $query->orderBy('e_id', $orderBy);
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
