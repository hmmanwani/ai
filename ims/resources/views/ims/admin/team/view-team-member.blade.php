<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Admin Team Member" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_horizontal-navbar.html -->
        <x-header />
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper">
                    {{-- Start Design --}}
                    <section id="">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-3">
                                    <x-admin-sidebar />
                                </div>
                                <div class="col-md-9">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 align-self-center">
                                                    <h1 class="">View Team</h1>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end">
                                                    <a href="javascript:void(0)" id="add-team-member"
                                                        class="btn btn-primary">
                                                        <i class="fa fa-plus f-24 f-white" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h2 class="f-base d-flex justify-content-center">Team -
                                                        {{ $team->team }}</h2>
                                                    <div class="org-chart">
                                                        @foreach ($teamMembers->where('level', 0) as $member)
                                                            <div class="node">
                                                                <div class="team-member">
                                                                    <div class="card profile-pic">
                                                                        <div class="card-body f-20 f-700">
                                                                            {{ $member->fname }} {{ $member->lname }}
                                                                            <div class="edit"><a
                                                                                    href="javascript:void(0)"
                                                                                    id="edit-team-member"
                                                                                    data-id="{{ $member->team_member_e_id }}"><i
                                                                                        class="fa fa-trash "
                                                                                        aria-hidden="true"></i></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if ($teamMembers->where('level', 1)->where('p_id', $member->team_member_e_id)->count() > 0)
                                                                    <div class="sub-tree">
                                                                        @foreach ($teamMembers->where('level', 1)->where('p_id', $member->team_member_e_id) as $middleMember)
                                                                            <div class="node">
                                                                                <div class="team-member">
                                                                                    <div class="card ">
                                                                                        <div
                                                                                            class="card-body f-18 f-600">
                                                                                            {{ $middleMember->fname }}
                                                                                            {{ $middleMember->lname }}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                @if ($teamMembers->where('level', 2)->where('p_id', $middleMember->team_member_e_id)->count() > 0)
                                                                                    <div class="sub-tree">
                                                                                        @foreach ($teamMembers->where('level', 2)->where('p_id', $middleMember->team_member_e_id) as $bottomMember)
                                                                                            <div class="node no-child">
                                                                                                <div
                                                                                                    class="team-member">
                                                                                                    <div class="card">
                                                                                                        <div
                                                                                                            class="card-body f-16 f-500">
                                                                                                            {{ $bottomMember->fname }}
                                                                                                            {{ $bottomMember->lname }}
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    {{-- End Start Design --}}
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <x-footer-con />

                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <div class="modal" tabindex="-1" id="addteammembermodel" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ url('/submit-team-member') }}" method="POST" id="myForm">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Team</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-12 f-600 control-label required">Level:</label>
                                        <select id="level" name="level" class="form-select form-control"
                                            required="" onchange="toggleSeniorNameDropdown()"
                                            aria-placeholder="Choose a Level">
                                            <option value="">Choose a Level</option>
                                            @if (!in_array(0, $levels))
                                                <option value="0">Top</option>
                                            @endif
                                            <option value="1">Middle</option>
                                            <option value="2">Bottom</option>
                                        </select>

                                    </div>
                                    @foreach ($emp as $team)
                                        <input type="hidden" name="id" value="{{ $team->team }}">
                                    @endforeach
                                    <div class="form-group">
                                        <label class="col-sm-12 f-600 control-label required">Employee Name:</label>
                                        <select name="ename" id="ename" class="form-select form-control">
                                            <option value="" value="">-Select Employee name-</option>
                                            @foreach ($emp as $team)
                                                <option>{{ $team->fname }}
                                                    {{ $team->lname }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group" id="seniorNameGroup" style="display: none;">
                                        <label class="col-sm-12 f-600 control-label required">Senior Name:</label>
                                        <select name="sname" id="sname" class="form-select form-control">
                                            <option value="">-Select Senior name-</option>
                                            @foreach ($emp as $team)
                                                <option>{{ $team->fname }}
                                                    {{ $team->lname }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-footer />
    <script>
        $('#add-team-member').click(function() {
            $('#addteammembermodel').modal('show');
        })
    </script>
    <script>
        function toggleSeniorNameDropdown() {
            var level = $('#level').val();
            var seniorNameGroup = $('#seniorNameGroup');
            if (level === '1' || level === '2') {
                seniorNameGroup.show();
            } else {
                seniorNameGroup.hide();
            }
        }
    </script>
</body>

</html>
