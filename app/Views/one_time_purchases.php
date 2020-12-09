<script>
    function changeButtons(e1) {
        if (e1.innerHTML === "Edit") {
            e1.innerHTML = "Cancel";
            document.getElementById("add").innerHTML = "Update Purchase";
            document.getElementById("update").value=e1.id;
        } else {
            e1.innerHTML = "Edit";
            document.getElementById("add").innerHTML = "Add New Purchase";
            document.getElementById("update").value=-1;
        }
    }

    function deleteBtn(e1) {
        document.getElementById("update").value=e1.id;
        document.getElementById('delete').value='true';
        document.getElementById('add').click();
    }
</script>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Hello <?= session()->get('first_name')?>  <?= session()->get('last_name') ?></h1>

            <h2>Please enter your one-time payments (new phone, house repairs, vacations, etc.)</h2>


            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col"><center>Purchase</center></th>
                    <th scope="col"><center>Amount</center></th>
                    <th scope="col"><center>Edit</center></th>
                    <th scope="col"><center>Delete</center></th>
                </tr>
                </thead>

                <?php foreach ($purchases->getResult() as $row)
                {
                    echo "<tr>";
                    echo "<td><center>" . $row->purchase . "</center></td>";
                    echo "<td><center>$" . $row->amount  . "</center></td>";
                    echo "<td><center>" . "<button id='" . $row->purchase_id . "'onclick=\"return changeButtons(this)\">Edit</button>" . "</center></td>";
                    echo "<td><center>" . "<button id='" . $row->purchase_id . "'onclick=\"return deleteBtn(this)\">Delete</button>" . "</center></td>";
                    echo "</tr>";
                }?>
            </table>

            <form action="./one_time_purchases" method="post">
                <input type="hidden" id="update" name="update" value=-1>
                <input type="hidden" id="delete" name="delete" value="false">
                <div class="form-group">
                    <label for="purchase">Monthly Purchase Item</label>
                    <input type="text" class="form-control" name="purchase" id="purchase" value="<?= set_value('purchase') ?>">
                </div>

                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="text" class="form-control" name="amount" id="amount" value="<?= set_value('amount') ?>">
                </div>

                <button type="submit" class="btn btn-primary" id="add">Add New Purchase</button>
            </form>
        </div>
    </div>
</div>