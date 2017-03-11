<div class="box">
    <div class="box-header with-border">
        <h2 class="box-title">Assign Permissions</h2>
    </div>
    <div class="box-body">
        <form class="form-horizontal" role="form" method="POST" action="{{url('role/'.$role->id.'/permissions') }}">
            {!! csrf_field() !!}

            <div class="col-xs-12">

                <table class="table table-bordered table-responsive">
                    <tr>
                        <td>
                            <h4>Staff Members</h4>
                        </td>
                        <td>
                            <p><strong>Note :</strong>This is the default permission for any registered user .</p>

                            <p> Normally Staff members could view their own belonging orders
                                without any
                                security requirements ,
                                But for any other staff member trying to view others` orders ,
                                they will be promoted to enter the order`s key sent to the creator by email.
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
                                    <input type="checkbox" name="permissions[]" value="labor_privileges"
                                            {{$permissions->contains('labor_privileges')?'checked':''}}>&nbsp;&nbsp;&nbsp;&nbsp;
                                    Allowed to view
                                    orders in which he assigned as a labor .
                                </label>
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
                                    <input type="checkbox" name="permissions[]" value="technician_privileges"
                                            {{$permissions->contains('technician_privileges')?'checked':''}}>&nbsp;&nbsp;&nbsp;&nbsp;
                                    Allowed to view
                                    orders in which he assigned as a technician .
                                </label>
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
                                    <input type="checkbox" name="permissions[]" value="vendor_privileges"
                                            {{$permissions->contains('vendor_privileges')?'checked':''}}>&nbsp;&nbsp;&nbsp;&nbsp;
                                    Allowed to view
                                    orders in which he assigned as a vendor (external ) .
                                </label>
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
                                    <input type="checkbox" name="permissions[]" value="accountant_privileges"
                                            {{$permissions->contains('accountant_privileges')?'checked':''}}>&nbsp;&nbsp;&nbsp;&nbsp;
                                    Allowed to view
                                    Financial pages ,
                                    for used materials and costs .
                                </label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Administrators
                        </td>
                        <td>
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="admin_privileges"
                                            {{$permissions->contains('admin_privileges')?'checked':''}}>&nbsp;&nbsp;&nbsp;&nbsp;
                                    Allowed to do
                                    everything except Roles and
                                    permissions .
                                </label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            SuperAdministrators
                        </td>
                        <td>
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="superadmin_privileges"
                                            {{$permissions->contains('superadmin_privileges')?'checked':''}}>&nbsp;&nbsp;&nbsp;&nbsp;
                                    Can do everything
                                    in every where .
                                </label>
                            </div>
                        </td>
                    </tr>

                </table>

            </div>

            <!--Submit-->
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary pull-right">
                        <i class="fa fa-btn fa-send"></i> Assign Permissions
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>