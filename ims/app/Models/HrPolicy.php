<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrPolicy extends Model
{
    use HasFactory;
    protected $table = 'hr-policy';


    public static function gethrpolicylist($Data, $sort_field, $orderBy, $c)
    {
        $query = HrPolicy::query();
        if (!empty($Data['search']['value'])) {
            $query->where('hp_id', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('year', "LIKE", "%{$Data['search']['value']}%");
        }
        $query->orderBy('hp_id', $orderBy);
        if ($c == 1) {
            if ($Data['length'] != -1) {
                $query->offset($Data['start']);
                $query->limit(3);
            }
            return $query->get();
        } else {
            $result['NumRecords'] = $query->count();
            return $result;
        }
    }
    // admin hr policy
    public static function getadminhrpolicylist($Data, $sort_field, $orderBy, $c)
    {
        $query = HrPolicy::query();
        if (!empty($Data['search']['value'])) {
            $query->where('hp_id', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('year', "LIKE", "%{$Data['search']['value']}%");
        }
        $query->orderBy('hp_id', $orderBy);
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