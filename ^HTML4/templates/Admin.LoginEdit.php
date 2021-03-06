<?php get_header(); ?>

    <ul class="breadcrumbs">
        <li><a href="<?php echo CONT;?>Admin">Admin</a></li>
        <li><a href="<?php echo CONT;?>Admin/Login">Logins</a></li>
    </ul>

<?php include 'Admin.LoginSearch.php'; ?>

<form action="<?php echo CONT.'Admin/LoginEdit/'.$L->login_id;?>" method="post">
    <div class="fleft">
        <h2>Edit Account Settings</h2>

        <table class="formTable">
            <tr>
                <th>LoginName</th>
                <td><input type="text" name="loginname" value="<?php html($L->loginname);?>"></td>
            </tr>
            <tr>
                <th>Real Name</th>
                <td><input type="text" name="realname" value="<?php html($L->realname);?>"></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><input type="password" name="pass1"></td>
            </tr>
            <tr>
                <th>Confirm Password</th>
                <td><input type="password" name="pass2"></td>
            </tr>
            <tr>
                <th>E-Mail Address</th>
                <td><input type="text" name="email1" id="email1" value="<?php html($L->email);?>" class="js-validate-email-stricter">
                        <label class="msg" for="email1" id="email1Msg"></label>
                </td>
            </tr>
            <tr>
                <th>Confirm E-Mail Address</th>
                <td><input type="text" name="email2" id="email2" value="<?php html($L->email);?>" class="js-validate-email-stricter">
                        <label class="msg" for="email2" id="email2Msg"></label>
                </td>
            </tr>
            <tr>
                <th>Session Strength</th>
                <td><select name="sessionStrength">
                        <option value="2">Secure session to Browser and IP</option>
                        <option value="1"<?php if (1==$L->sessionStrength) {echo ' selected';}?>>Secure session to Browser only</option>
                        <option value="0"<?php if (0==$L->sessionStrength) {echo ' selected';}?>>Allow multiple concurrent sessions</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Must Change Password?</th>
                <td><select name="flagChangePass">
                        <option value="0">No</option>
                        <option value="1"<?php if (1==$L->flagChangePass) {echo ' selected';}?>>Yes</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Disabled?</th>
                <td><select name="disabled">
                        <option value="0">No, User is Enabled</option>
                        <option value="1"<?php if (1==$L->disabled) {echo ' selected';}?>>Yes, User is Disabled</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th>Referring Login</th>
                <td><a href="<?php echo CONT;?>Admin/LoginEdit/<?php echo $L->referrer_id;?>"><?php html($referrer);?></a></td>
            </tr>
            <tr>
                <th>Created</th>
                <td><?php echo $L->dateCreated?date('r', $L->dateCreated):'Never';?></td>
            </tr>
            <tr>
                <th>Modified</th>
                <td><?php echo $L->dateModified?date('r', $L->dateModified):'Never';?></td>
            </tr>
            <tr>
                <th>Checked In</th>
                <td><?php echo $L->dateLogin?date('r', $L->dateLogin):'Never';?></td>
            </tr>
            <tr>
                <th>Checked Out</th>
                <td><?php echo $L->dateLogout?date('r', $L->dateLogout):'Never';?></td>
            </tr>
            <tr>
                <th>Active</th>
                <td><?php echo $L->dateActive?date('r', $L->dateActive):'Never';?></td>
            </tr>
            <tr>
                <th>Last IP</th>
                <td><?php echo $L->lastIP;?></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="Submit">
                    <input type="hidden" name="login_id" value="<?php echo $L->login_id;?>">
                </td>
            </tr>
        </table>
    </div>

    <div class="fleft" style="border-top:1px solid transparent;">
        <h2>Grant Roles</h2>

        <table class="listTable">
            <thead>
                <tr>
                    <th>Grant<input type="hidden" name="grant[]" value="0"></th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
<?php
if (is_array($Roles)) {
    foreach ($Roles as $k => $v) {
?>
        <tr>
            <td><input type="checkbox" name="grant[<?php echo $k;?>]" id="g<?php echo $k;?>" value="1"<?php if ($L->roleTest($v->label)) {echo ' checked';}?>></td>
            <td><label for="g<?php echo $k;?>"><?php echo $v->label;?></label></td>
        </tr>
<?php
    }
}
?>
            </tbody>
        </table>
    </div>

    <div class="fleft" style="border-top:1px solid transparent;">
        <h2>Login Log</h2>
        <table class="listTable">
            <thead>
                <tr>
                    <th>pkey</th>
                    <th>date</th>
                    <th>IP</th>
                    <th>user agent</th>
                </tr>
            </thead>
            <tbody>
<?php
if (is_array($log) && count($log)) {
    foreach ($log as $k => $v) {
?>
                <tr>
                    <td><?php html($v->pkey);?></td>
                    <td><?php echo date("r", $v->iDate); ?></td>
                    <td><?php html($v->ip);?></td>
                    <td><?php html($v->ua);?></td>
                </tr>
<?php
    }
} else {
?>
        <tr><td colspan="4">No records found.</td></tr>
<?php
}
?>
            </tbody>
        </table>
    </div>

</form>
<?php get_footer();
