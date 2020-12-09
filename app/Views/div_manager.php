<script>
    function changeButtons(e1) {
        if (e1.innerHTML === "Edit") {
            e1.innerHTML = "Cancel";
            document.getElementById("add").innerHTML = "Update Dividend";
            document.getElementById("update").value=e1.id;
        } else {
            e1.innerHTML = "Edit";
            document.getElementById("add").innerHTML = "Add New Dividend Received";
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

            <h2>Please enter your dividends received</h2>


            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col"><center>Stock</center></th>
                    <th scope="col"><center>Dividend Amount</center></th>
                    <th scope="col"><center>Shares</center></th>
                    <th scope="col"><center>Total Dividend Amount</center></th>
                    <th scope="col"><center>Date Received</center></th>
                    <th scope="col"><center>Edit</center></th>
                    <th scope="col"><center>Delete</center></th>
                </tr>
                </thead>

                <?php foreach ($dividends->getResult() as $row)
                {
                    echo "<tr>";
                    echo "<td><center>" . $row->stock . "</center></td>";
                    echo "<td><center>$" . $row->amount  . "</center></td>";
                    echo "<td><center>" . $row->shares . "</center></td>";
                    echo "<td><center>$" . ($row->amount*$row->shares) . "</center></td>";
                    echo "<td><center>" . $row->date_received . "</center></td>";
                    echo "<td><center>" . "<button id='" . $row->dividend_id . "'onclick=\"return changeButtons(this)\">Edit</button>" . "</center></td>";
                    echo "<td><center>" . "<button id='" . $row->dividend_id . "'onclick=\"return deleteBtn(this)\">Delete</button>" . "</center></td>";
                    echo "</tr>";
                }?>
            </table>

            <form action="./div_manager" method="post">

                <input type="hidden" id="update" name="update" value=-1>
                <input type="hidden" id="delete" name="delete" value="false">
                <div class="form-group">
                    <label for="stock">Stock Ticker</label>
                    <select name="stock" id="stock">
                        <?php
                            foreach ($stocks->getResult() as $stock) {
                                echo "<option value=" . $stock->stock_id . ">" . $stock->stock . ": " . $stock->shares . " shares, " . $stock->date_purchased . " @ $" . $stock->price . "</option>";
                            }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="dividend">Dividend Amount</label>
                    <input type="text" class="form-control" name="dividend" id="dividend" value="<?= set_value('dividend') ?>">
                </div>

                <button type="submit" class="btn btn-primary" id="add">Add New Dividend Received</button>
            </form>

        </div>
    </div>
</div>