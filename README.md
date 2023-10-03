# Russel Street Medical

## Workspace - using Laragon for Testing

### Table - Appointments Scheduler/Manager

###### _Example:_

```PHP

<form method="post" action="misc/action.php" class="form">
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <?php
                $APPOINTER = new Appointment();

                foreach ($APPOINTER->FetchAppointmentData("etc/appointments.txt") as $key => $value) {
                    for ($i = 0; $i < sizeof($APPOINTER->FetchAppointmentData($RootDirectory)); $i++) {
                ?>
                        <th scope="col">
                            <?= htmlspecialchars($key); ?>
                        </th>
            </tr>
            <input type="text" name="user" class="form-control">
        </thead>

        <tr>
            <th scope="row"></th>
            <td> <?= htmlspecialchars($value); ?> </td>
            <input type="datetime-local" name="date" class="form-control">
        </tr>
<?php
                    }
                }

                foreach ($CurrentUsers as $user) {
                    printf("%s", validate_login_credentials());
                }
?>

    </table>

    <button type="submit" onclick="<?php $APPOINTER->UpdateAppointmentData("etc/appointments.txt") ?>">Add Administrator</button>
</form>

```
