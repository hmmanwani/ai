<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TaskManage extends Model
{
    use HasFactory;
    protected $table = 'task_manage';

    public static function gettasklist($Data, $sort_field, $orderBy, $c)
    {
        $empLogin = session('emp_login');
        $e_id = $empLogin['e_id'];

        $query = TaskManage::query();

        $query->join('employee as em', 'task_manage.created_by', '=', 'em.e_id')
            ->selectRaw("task_manage.*, CONCAT(em.fname, ' ', em.lname) as assign_by_name");

        if (!empty($Data['search']['value'])) {
            $searchValue = $Data['search']['value'];
            $query->where(function ($q) use ($searchValue) {
                $q->where('tm_id', 'LIKE', "%{$searchValue}%")
                    ->orWhere('task_type', 'LIKE', "%{$searchValue}%")
                    ->orWhere('deadline', 'LIKE', "%{$searchValue}%")
                    ->orWhere('task_title', 'LIKE', "%{$searchValue}%")
                    ->orWhere('task_manage.status', 'LIKE', "%{$searchValue}%")
                    ->orWhereRaw("CONCAT(em.fname, ' ', em.lname) LIKE ?", ["%{$searchValue}%"])
                    ->orWhereRaw('JSON_CONTAINS(assign_task, ?)', [json_encode($searchValue)]);
            });
        }


        if (!in_array($empLogin['team'], [1, 2])) {
            if ($empLogin['team_lead'] == 1) {
                $teamMemberIds = Employee::where('team', $empLogin['team'])
                    ->pluck('e_id')
                    ->toArray();
                $query->where(function ($query) use ($teamMemberIds, $e_id) {
                    $query->whereIn('task_manage.created_by', $teamMemberIds)
                        ->orWhereRaw('JSON_CONTAINS(assign_task, ?)', [json_encode((string)$e_id)]);
                });
            } else {
                $query->whereRaw('JSON_CONTAINS(assign_task, ?)', [json_encode((string)$e_id)]);
                $query->orWhere('task_manage.created_by', $e_id);
            }
        }

        // if (!empty($Data['filters']['status'])) {
        //     $query->where('task_manage.status', '=', $Data['filters']['status']);
        // }

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
}
