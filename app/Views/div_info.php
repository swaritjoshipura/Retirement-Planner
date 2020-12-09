<script>
    function changeButtons(e1) {
        if (e1.innerHTML === "Edit") {
            e1.innerHTML = "Cancel";
            document.getElementById("addStock").innerHTML = "Update Stock Purchase";
            document.getElementById("update").value=e1.id;
        } else {
            e1.innerHTML = "Edit";
            document.getElementById("addStock").innerHTML = "Add New Stock Purchase";
            document.getElementById("update").value=-1;
        }
    }
</script>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Hello <?= session()->get('first_name')?>  <?= session()->get('last_name') ?></h1>

            <h2>Please enter your stock transactions</h2>


            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col" style="text-align: center;">Stock</th>
                    <th scope="col" style="text-align: center;">Price</th>
                    <th scope="col" style="text-align: center;">Shares</th>
                    <th scope="col" style="text-align: center;">Exchange</th>
                    <th scope="col" style="text-align: center;">Bought</th>
                    <th scope="col" style="text-align: center;">Edit</th>
                </tr>
                </thead>

                <?php foreach ($stocks->getResult() as $row)
                {
                    echo "<tr>";
                    echo "<td><center>" . $row->stock . "</center></td>";
                    echo "<td><center>$" . $row->price  . "</center></td>";
                    echo "<td><center>" . $row->shares . "</center></td>";
                    echo "<td><center>" . $row->exchange . "</center></td>";
                    echo "<td><center>" . $row->date_purchased . "</center></td>";
                    echo "<td><center>" . "<button id='" . $row->stock_id . "'onclick=\"return changeButtons(this)\">Edit</button>" . "</center></td>";
                    echo "</tr>";
                }?>
            </table>

            <form action="./div_info" method="post">
                <input type="hidden" id="update" name="update" value=-1>

                <div class="form-group">
                    <label for="stock">Stock Ticker</label>
                    <input type="text" class="form-control" name="stock" id="stock" value="<?= set_value('stock') ?>">
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" name="price" id="price" value="<?= set_value('price') ?>">
                </div>

                <div class="form-group">
                    <label for="shares">Shares</label>
                    <input type="text" class="form-control" name="shares" id="shares" value="<?= set_value('shares') ?>">
                </div>

                <div class="form-group">
                    <label for="exchange">Exchange</label>
                    <input type="text" class="form-control" name="exchange" id="exchange" value="<?= set_value('exchange') ?>">
                </div>

                <button type="submit" class="btn btn-primary" id="addStock">Add New Stock Purchase</button>
            </form>
        </div>
    </div>
</div>