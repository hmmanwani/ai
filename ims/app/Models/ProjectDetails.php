<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDetails extends Model
{
    use HasFactory;
    protected $table = 'project_details';
    public static function getprojectlist($Data, $sort_field, $orderBy, $c)
    {
        $empLogin = session('emp_login');
        $e_id = $empLogin['e_id'];
        // return $e_id
        $query = ProjectDetails::query();
        if (!empty($Data['search']['value'])) {
            $query->where('p_id', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('project_title', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('start_date', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('end_date', "LIKE", "%{$Data['search']['value']}%");
        }

        if (!in_array($empLogin['team'], [1, 2])) {
            if ($empLogin['team_lead'] == 1) {
                $query->whereRaw('emp LIKE ?', ['%"' . $e_id . '"%'])->get();
            } else {
                $query->whereRaw('sub_emp LIKE ?', ['%"' . $e_id . '"%'])->get();
            }
        }

        $query->orderBy('p_id', $orderBy);
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
