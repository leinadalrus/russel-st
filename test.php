<?php

include_once './tools.php';
include_once './accessattempts.php';
include_once './appointments.php';
?>

<?php
foreach ($CurrentUsers as $user)
    echo "<h1> Welcome $user </h1>";
?>

<form method="post" action="misc/action.php" class="custom-form-container">
    <table>
        <tr>
            <th>

                <?php
                include_once "./appointments.php";

                $APPOINTER = new Appointment();

                foreach ($APPOINTER->FetchAppointmentData("etc/accessattempts.txt") as $key => $value) {
                    for ($i = 0; $i < sizeof($APPOINTER->FetchAppointmentData($RootDirectory)); $i++) {
                ?>
                        <?= htmlspecialchars($key); ?>

            </th>
        </tr>

        <tr>
            <td> <?= htmlspecialchars($value); ?> </td>
        </tr>
<?php
                    }
                }

                foreach ($CurrentUsers as $user) {
                    printf("%s", validate_login_credentials());
                }

?>

    </table>

    <button type="submit" id="login-button-style" onclick="<?php $APPOINTER->UpdateAppointmentData("etc/appointments.txt") ?>">Add Administrator</button>
</form>