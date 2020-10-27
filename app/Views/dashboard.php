<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Hello <?= session()->get('first_name')?>  <?= session()->get('last_name') ?></h1>

            <h2>Please enter your stock purchases</h2>


            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Stock</th>
                    <th scope="col">Price</th>
                    <th scope="col">Shares</th>
                    <th scope="col">Exchange</th>
                </tr>
                </thead>

                <?php foreach ($stocks->getResult() as $row)
                {
                    echo "<tr>";
                    echo "<td><center>" . $row->stock . "</center></td>";
                    echo "<td><center>" . $row->price  . "</center></td>";
                    echo "<td><center>" . $row->shares . "</center></td>";
                    echo "<td><center>" . $row->exchange . "</center></td>";
                    echo "</tr>";
                }?>
            </table>

            <form action="./dashboard" method="post">
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

                <button type="submit" class="btn btn-primary">Add New Stock Purchase</button>
            </form>
        </div>
    </div>
</div>