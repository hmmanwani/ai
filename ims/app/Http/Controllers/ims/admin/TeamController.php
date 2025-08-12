<?php

namespace App\Http\Controllers\ims\admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Employee;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function team()
    {
        $data = Team::all();
        return view('ims/admin/team/team', ['data' => $data]);
    }
    public function submit_team(Request $req)
    {
        $team = new Team();
        $team->team = $req->team;
        $save =  $team->save();
        if ($save) {
            session()->flash('notification', ['type' => 'success', 'message' => "Team Add successfully"]);
            return redirect('team');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect(url('overview'));
        }
    }
    /* --------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : Team List
     use for  : Fetch the Team details in datatable using Ajax
     ---------------------------------------------------------------------------------------------------------*/
    public function get_team(Request $request)
    {
        $post = $request->input();
        if ($post) {
            $field_pos = array('t_id' => '0', 'team' => '1');
            $sort_field = array_search($post['order']['0']['column'], $field_pos);
            if ($post['order']['0']['dir'] == 'asc') {
                $orderBy = "ASC";
            } else {
                $orderBy = 'DESC';
            }
            $TotalRecord = Team::getteamlist($post, $sort_field, $orderBy, 0);
            $team = Team::getteamlist($post, $sort_field, $orderBy, 1);
            $iTotalRecords = $TotalRecord['NumRecords'];
            $records = array();
            $records['data'] = array();
            foreach ($team as $key => $value) {
                $teamN = Team::where('t_id', $value->t_id)->first();
                $action = '<div class="d-flex  gap-4">
                <div class="d-flex f-18 "> <a href="javascript:void(0)" data-id="' . $value->t_id . '"  class="delete-check"><i class="fa fa-trash" aria-hidden="true"></i></a></div>
                <div class="d-flex f-18 justify-content-center"><a href="javascript:void(0)" id="edit-team_' . $value->t_id  . '" data-id="' . $value->t_id . '" data-value="' . $teamN->team . '"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
                <div class="d-flex f-18 justify-content-center d-none"><a href="' . URL('') . '/view-team-member/' . $value->t_id . '"><i class="fa fa-sitemap" aria-hidden="true"></i></a></div>
                </div>';
                $records['data'][] = array(
                    $value->t_id,
                    $value->team,
                    $action,
                );
            }
            $records['draw'] = intval($post['draw']);
            $records['recordsTotal'] = $iTotalRecords;
            $records['recordsFiltered'] = $iTotalRecords;
            echo json_encode($records);
            exit();
        }
    }
    public function getTeamMemberCount($id)
    {
        $count = Employee::where('team', $id)->count();
        return response()->json(['count' => $count]);
    }
    public function edit_team(Request $req)
    {
        $save = Team::where('t_id', $req->id)->update(['team' => $req->team]);
        if ($save) {
            session()->flash('notification', ['type' => 'success', 'message' => "Team updated successfully."]);
            return redirect()->back();
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect(url('team'));
        }
    }
    public function deleteTeam($id)
    {
        if ($id) {
            $employees = Employee::where('team', '=', $id)->update(['status' => 'Inactive']);
            Team::where('t_id', '=', $id)->delete();
            session()->flash('notification', ['type' => 'success', 'message' => "Team deleted successfully."]);
            return redirect('team');
        } else {
            return redirect()->back()->with('error', 'Team not found.');
        }
    }
    public function view_team_member($id)
    {
        $emp = Employee::where('team', $id)->select('fname', 'lname', 'designation', 'team')->get();
        $level = TeamMember::where('team', $id)->pluck('level')->toArray();
        $teamMembers = TeamMember::where('team_member.team', $id)
            ->join('employee', 'employee.e_id', '=', 'team_member.e_id')
            ->select('team_member.tm_id', 'team_member.level', 'team_member.e_id as team_member_e_id', 'team_member.p_id', 'team_member.team as team_member_team', 'employee.fname', 'employee.e_id', 'employee.lname')
            ->get();
        $team = Team::where('t_id', $id)->first();
        return view('ims/admin/team/view-team-member', ['emp' => $emp, 'levels' => $level, 'id' => $id, 'teamMembers' => $teamMembers, 'team' => $team]);
    }
    public function submit_team_member(Request $req)
    {
        list($fname, $lname) = explode(' ', $req->ename);
        $ename = Employee::where('fname', $fname)
            ->where('lname', $lname)
            ->select('e_id')
            ->first();
        if (is_null($req->sname)) {
            $sname = 0;
        } else {
            list($fname, $lname) = explode(' ', $req->sname);
            $sname = Employee::where('fname', $fname)
                ->where('lname', $lname)
                ->select('e_id')
                ->first();
        }
        $member = new TeamMember();
        $member->level = $req->level;
        $member->e_id = $ename->e_id;
        $member->p_id = $sname ? $sname->e_id : null;
        $member->team = $req->id;
        $save = $member->save();
        if ($save) {
            session()->flash('notification', ['type' => 'success', 'message' => "Team member added successfully."]);
            return redirect()->back();
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect(url('overview'));
        }
    }
}