<?php
include_once "./appointments.php"; 


?>

<section>
    <table class="table table-dark table-striped table-bordered border-primary">
        <thead>
            <tr>
                <?php
                foreach (fetch_appointments("etc/appointments.txt") as $key => $value) {
                ?>
                    <th scope="col">
                        <?= htmlspecialchars($key); ?>
                    </th>
            </tr>
        </thead>

        <tr>
            <th scope="row"></th>
            <td> <?= htmlspecialchars($value); ?> </td>
        </tr>

    <?php
                }

                foreach ($CurrentUsers as $user) {
                    printf("%s", validate_login_credentials());
                }
    ?>

    </table>
</section>

<section>
    <form action="./appointments.php" method="post">
        <form class="row gx-3 gy-2 align-items-center">
            <div class="col-md-4">
                <label for="validationServer01" class="form-label">Last name</label>
                <input type="text" class="form-control is-valid" id="validationServer01" value="" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>

            <div class="col-md-4">
                <label for="validationServer02" class="form-label">First name</label>
                <input type="text" class="form-control is-valid" id="validationServer02" value="" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>

            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <span class="input-group-text" id="basic-addon2">@russelstreet.medical.com</span>
            </div>

            <div class="col-md-4">
                <input type="date" class="form-control" placeholder="Date" aria-label="Date" aria-describedby="basic-addon2">
            </div>

            <div class="col-md-4">
                <label for="formFile" class="form-label">Default file input example</label>
                <input class="form-control" type="file" id="formFile">
            </div>

            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </form>
</section>

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