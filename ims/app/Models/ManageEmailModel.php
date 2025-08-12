<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageEmailModel extends Model
{
    use HasFactory;
    protected $table = 'manage_email';

    public static function getemailtypelist($Data, $sort_field, $orderBy, $c)
    {
        $query = ManageEmailModel::query();
        if (!empty($Data['search']['value'])) {
            $query->where('me_id', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('type', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('email_to', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('email_cc', "LIKE", "%{$Data['search']['value']}%");
        }
        $query->orderBy('me_id', $orderBy);
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