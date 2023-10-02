<script>
    $(function() {
        $(".portrait-image-carousel").slick()
    })
</script>

<section>
    <article>
        <img class="portrait-image-carousel">
    </article>
</section>

<?php
include_once "./appointments.php";

if (isset($_GET["signage"]))
    validate_remote_usage();
else
    require "./login.php";

if (isset($_POST["email"]))
    foreach ($CurrentUsers as $user)
        echo "<h1> Welcome $user </h1>";
?>

<form method="post" action="misc/action.php">
    <table>
        <tr>
            <th>

                <?php
                $APPOINTER = new Appointment();

                foreach ($APPOINTER->FetchAppointmentData("etc/appointments.txt") as $key => $value) {
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

    <button type="submit" onclick="<?php $APPOINTER->UpdateAppointmentData("etc/appointments.txt") ?>">Add Administrator</button>
</form>

<style>
    table {
        font-family: Lora, sans-serif;
        padding-top: 10%;
        max-width: 100%;
        height: 100%;
        margin: auto;
        text-align: start;
        text-align-last: right;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    th,
    td {
        border-bottom: 0.1rem dashed #0af;
        text-align: center;
        text-align-last: right;
        padding: 1rem;
        margin: 0.1rem;
        max-width: 50%;
        max-height: 50%;
    }

    tr:hover {
        color: #fff;
        background-color: #0af;
    }
</style>