<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wfh extends Model
{
    use HasFactory;
    protected $table = 'wfh';

    public static function getWfhList($data, $sortField, $orderBy, $c)
    {
        // return $data;
        $query = Wfh::query();
        if (!empty($data['search']['value'])) {
            // $query->where('wfh_id', 'LIKE', "%{$data['search']['value']}%")
            //    $query->where('apply_for', 'LIKE', "%{$data['search']['value']}%")
            //     ->orWhere('apply_reason', 'LIKE', "%{$data['search']['value']}%")
            //     ->orWhere('fname', 'LIKE', "%{$data['search']['value']}%")
            //     ->orWhere('lname', 'LIKE', "%{$data['search']['value']}%");
        }
        if (!empty($data['filters']['s_date'])) {
            $s_date = date("Y-m-d", strtotime($data['filters']['s_date']));
            $query->where('wfh.wfh_date', '>=', $s_date);
        }
        if (!empty($data['filters']['e_date'])) {
            $e_date = date("Y-m-d", strtotime($data['filters']['e_date']));
            $query->where('wfh.wfh_date', '<=', $e_date);
        }
        if (!empty($data['filters']['s_date']) && !empty($data['filters']['e_date'])) {
            $query->whereBetween('wfh.wfh_date', [$s_date, $e_date]);
        }
        $query->select('wfh.*', 'em.fname', 'em.lname');
        $query->join('employee as em', 'em.e_id', '=', 'wfh.wfh_responsible_person');
        $query->where('wfh.e_id', $data['filters']['e_id']);
        $query->orderBy('wfh_id', $orderBy);

        if ($c == 1) {
            if ($data['length'] != -1) {
                $query->offset($data['start']);
                $query->limit($data['length']);
            }
            return $query->get();
        } else {
            $result['NumRecords'] = $query->count();
            return $result;
        }
    }
    public static function getWfhLeaveAdmin($Data, $sort_field, $orderBy, $c)
    {
        $query = Wfh::query();
        if (!empty($Data['search']['value'])) {
            $query->where('wfh_id', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('wfh_date', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('apply_for', "LIKE", "%{$Data['search']['value']}%");
        }
        $query->select('wfh.*',  'em.fname as r_fname', 'em.lname as r_lname', 'e.fname as e_fname', 'e.lname as e_lname');
        $query->join('employee as em', 'em.e_id', '=', 'wfh.wfh_responsible_person');
        $query->join('employee as e', 'e.e_id', '=', 'wfh.e_id');
        if ($Data['filters']['e_id'] != 'all') {
            $query->where('wfh.e_id', $Data['filters']['e_id']);
        }
        $query->where('wfh.status', 'Pending');
        $query->orderBy('wfh_id', $orderBy);
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
    public static function getApprovedwfhAdmin($Data, $sort_field, $orderBy, $c)
    {
        $query = Wfh::query();
       $query = Wfh::query();
        if (!empty($Data['search']['value'])) {
            $query->where('wfh_id', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('apply_for', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('e.fname', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('e.lname', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('apply_reason', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('em.fname', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('em.lname', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('wfh_date', "LIKE", "%{$Data['search']['value']}%");
        }  
        $query->select('wfh.*',  'em.fname as r_fname', 'em.lname as r_lname', 'e.fname as e_fname', 'e.lname as e_lname');
        $query->join('employee as em', 'em.e_id', '=', 'wfh.wfh_responsible_person');
        $query->join('employee as e', 'e.e_id', '=', 'wfh.e_id');
        if ($Data['filters']['e_id'] != 'all') {
            $query->where('wfh.e_id', $Data['filters']['e_id']);
        }
         if (!empty($Data['filters']['wfh_date'])) {
            $query->where('wfh_date',"=" ,(DateTime::createFromFormat('d-m-Y', $Data['filters']['wfh_date']))->format('Y-m-d'));
        }
        $query->whereIn('wfh.status', ['Approve', 'Reject']);
        $query->orderBy('wfh_date', $orderBy);
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
    public static function wfhDetails($id)
    {
        $query = wfh::query();
        $query->select('wfh.*', 'em.fname as r_fname', 'em.lname as r_lname', 'e.fname as e_fname', 'e.lname as e_lname');
        $query->join('employee as em', 'em.e_id', '=', 'wfh_responsible_person');
        $query->join('employee as e', 'e.e_id', '=', 'wfh.e_id');
        $query->where('wfh_id', $id);
        return $query->get();
    }
}
