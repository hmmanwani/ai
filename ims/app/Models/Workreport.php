<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Workreport extends Model
{
    use HasFactory;
    protected $table = 'work_report';
    protected $fillable = [
        'e_id',
        'team',
        'work_date',
        'work_title',
        'description',
    ];
   public static function getworklist($Data, $sort_field, $orderBy, $c)
    {
        $emp_login = session('emp_login');

        $query = DB::table('work_report')
            ->selectRaw('
            work_report.work_date,
            MIN(work_report.wr_id) AS wr_id,
            MIN(work_report.e_id) AS e_id,
            MIN(work_report.work_title) AS work_title,
            MIN(work_report.description) AS description,
            MIN(work_report.created_at) AS created_at,
            MIN(em.fname) AS fname,
            MIN(em.lname) AS lname,
            MIN(t.team) AS team
        ')
            ->join('employee as em', 'em.e_id', '=', 'work_report.e_id')
            ->join('teams as t', 't.t_id', '=', 'work_report.team');

        if (!empty($Data['search']['value'])) {
            $query->where('work_report.work_title', "LIKE", "%{$Data['search']['value']}%");
        }

        if (!empty($Data['filters']['s_date'])) {
            $s_date = date("Y-m-d", strtotime($Data['filters']['s_date']));
            $query->where('work_report.work_date', '>=', $s_date);
        }

        if (!empty($Data['filters']['e_date'])) {
            $e_date = date("Y-m-d", strtotime($Data['filters']['e_date']));
            $query->where('work_report.work_date', '<=', $e_date);
        }

        if (!empty($Data['filters']['text'])) {
            $query->where('work_report.description', 'LIKE', '%' . $Data['filters']['text'] . '%');
        }

        if (isset($Data['filters']['e_id']) && $Data['filters']['e_id'] != 'all') {
            $query->where('work_report.e_id', $Data['filters']['e_id']);
        } elseif (empty($Data['filters']['e_id']) && empty($Data['filters']['date'])) {
            $query->where('work_report.e_id', $emp_login['e_id']);
        }

        $query->groupBy('work_report.work_date');

        if ($c == 1) {
            $query->orderBy('work_report.work_date', 'desc');
            if ($Data['length'] != -1) {
                $query->offset($Data['start']);
                $query->limit($Data['length']);
            }
            return $query->get();
        } else {
            $countQuery = DB::table(DB::raw("({$query->toSql()}) as sub"))
                ->mergeBindings($query)
                ->count();

            return ['NumRecords' => $countQuery];
        }
    }
}
