<div class="panel panel-default ">
    <div class="panel-heading">

        <h4 style="font-family:roboto; text-align:center; font-weight:bold">USER SETTING</h4>
    </div>

    <?php foreach($user as $u): ?>

    <div class="col-lg-6"><br><br>


        <div class="panel panel-default">
            <div class="panel-heading">
                USER ADMIN
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <form role="form" method="post" action="<?php echo base_url('admin/user/editUser'); ?>">
                        <div>

                            <label class="control-label">Nama : </label>
                            <td>
                                <input class="form-control" type="text" name="nama_lengkap" id="nama_lengkap"
                                    value="<?php echo $u->nama_lengkap ?>" required="">
                            </td><br>

                            <label class="control-label">Username</label>
                            <td>
                                <input class="form-control" type="text" name="username" id="username"
                                    value="<?php echo $u->username ?>" required="">
                            </td>
                            <label class="control-label">Email</label>
                            <td>
                                <input class="form-control" type="text" name="email" id="email"
                                    value="<?php echo $u->email ?>" required="">
                            </td>
                            <label class="control-label">Password Email</label>
                            <td>
                                <input class="form-control"  type="password" name="password_email" id="password_email" required="">
                            </td>
                            <input type="checkbox" onclick="showPassemail()">Show Password
                            <br>
                            <label class="control-label">Password User</label>
                            <td>
                                <input class="form-control"  type="password" name="password_user" id="password_user" required="">
                            </td><br>
                            <input type="checkbox" onclick="showPassUser()">Show Password

                        </div><br>
                        <p style="text-align:center; font-weight:bold; color:green"><?php echo $this->session->flashdata('sukses');?></p>
                        <div>
                            <button class="btn btn-primary col-md-2 pull-right">Update</button>
                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>
    <?php endforeach; ?>



</div>

<script>
function showPassemail() {
    var x = document.getElementById("password_email");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
function showPassUser() {
    var x = document.getElementById("password_user");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>