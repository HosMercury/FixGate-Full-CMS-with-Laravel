<div class="box">
    <div class="box-header with-border">
        <h2 class="box-title">Assign Roles</h2>
    </div>
    <div class="box-body">
        <form class="form-horizontal" role="form" method="POST" action="/users/{{$user->employee_id}}/roles">
            {!! csrf_field() !!}

            <div class="col-xs-12">

                <table class="table table-bordered table-responsive">
                    <tr>
                        <td>
                            <h4>Staff Members</h4>
                        </td>
                        <td>
                            <p><strong>Note :</strong>This is the default permission for any registered user .</p>

                            <p> Normally Staff members could view their own belonging orders without any security requirements , But for any other staff member trying to view others` orders , they will be promoted to enter the order`s key sent to the creator by email.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Labor
                        </td>
                        <td>
                            <div class="checkbox icheck">
                                <label>
                                <input type="checkbox" name="roles[]" value="1" {{in_array('1',$roles)?'checked':''}}>Allowed to view orders in which he assigned as a labor .</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Technician
                            </td>
                            <td>
                                <div class="checkbox icheck">
                                    <label>
                                        <input type="checkbox" name="roles[]" value="2" {{in_array('2',$roles)?'checked':''}}>Allowed to view orders in which he assigned as a technician . </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Supervisors
                                </td>
                                <td>
                                    <div class="checkbox icheck">
                                        <label>
                                            <input type="checkbox" name="roles[]" value="3"{{in_array('3',$roles)?'checked':''}}>Allowed to assign , close and follow-up orders .</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Accountants
                                    </td>
                                    <td>
                                        <div class="checkbox icheck">
                                            <label>
                                                <input type="checkbox" name="roles[]" value="4" {{in_array('4',$roles)?'checked':''}}>Allowed to view Financial pages ,for used materials and costs .</label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            Admins
                                        </td>
                                        <td>
                                            <div class="checkbox icheck">
                                                <label>
                                                    <input type="checkbox" name="roles[]" value="5" {{in_array('5',$roles)?'checked':''}}> Allowed to do everything except Roles and permissions .</label>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                Superadmins
                                            </td>
                                            <td>
                                                <div class="checkbox icheck">
                                                    <label>
                                                        <input type="checkbox" name="roles[]" value="6"{{in_array('6',$roles)?'checked':''}}>Can do everything in every where .</label>
                                                    </div>
                                                </td>
                                            </tr>

                                        </table>

                                    </div>

                                    <!--Submit-->
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary pull-right">
                                                <i class="fa fa-btn fa-send"></i> Assign Roles
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>