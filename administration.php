<?= "<h1> Welcome {$CurrentUser}. </h1>" ?>

<form method="post" action="misc/action.php" class="custom-form-container">
    <table>
        <tr>
            <th>

                <?php
                $APPOINTER = new Appointment();

                foreach ($APPOINTER->FetchAppointmentData('etc/accessattempts.txt') as $key => $value) {
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

                if (isset($CurrentUser)) {
                    foreach ($CurrentUsers as $user) {
                        printf("%s", validate_login_credentials());
                    }
                }
?>

    </table>

    <button type="submit" id="login-button-style" onclick="<?php $APPOINTER->UpdateAppointmentData('etc/appointments.txt') ?>">Add Administrator</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ACCESS_ATTEMPTOR = new AccessAttempt();
    $ACCESS_ATTEMPTOR->UpdateAccessAttempts('etc/accessattempts.txt'); // TODO(Daud): need a regex file I/O automation
}
?>
