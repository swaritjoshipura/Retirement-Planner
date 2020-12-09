
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Hello <?= session()->get('first_name')?>  <?= session()->get('last_name') ?></h1>

            <h2>Dividend Income Analyzer</h2>

            <br>
            <h3>Total Dividend Returns on Stock</h3>
            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col"><center>Stock</center></th>
                    <th scope="col"><center>Total Dividends Received</center></th>
                    <th scope="col"><center>Total Cost</center></th>
                    <th scope="col"><center>Total Yield</center></th>
                </tr>
                </thead>

                <?php foreach ($share_recoup->getResult() as $row)
                {
                    echo "<tr>";
                    echo "<td><center>" . $row->stock . "</center></td>";
                    echo "<td><center>$" . round($row->dividends_received, 2)  . "</center></td>";
                    echo "<td><center>$" . round($row->shares_price, 2) . "</center></td>";
                    echo "<td><center>" . round($row->total_yield, 2) . "%</center></td>";
                    echo "</tr>";
                }?>
            </table>

            <br>
            <h3>Recurring Dividends</h3>
            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col"><center>Stock</center></th>
                    <th scope="col"><center>Cost</center></th>
                    <th scope="col"><center>Years</center></th>
                    <th scope="col"><center>Yearly Income</center></th>
                    <th scope="col"><center>Yearly Yield</center></th>
                    <th scope="col"><center>Months</center></th>
                    <th scope="col"><center>Monthly Income</center></th>
                    <th scope="col"><center>Monthly Yield</center></th>
                </tr>
                </thead>

                <?php foreach ($share_yields->getResult() as $row)
                {
                    echo "<tr>";
                    echo "<td><center>" . $row->stock . "</center></td>";
                    echo "<td><center>$" . $row->full_price  . "</center></td>";
                    echo "<td><center>" . $row->years . "</center></td>";
                    echo "<td><center>$" . round($row->yearly_income, 2) . "</center></td>";
                    echo "<td><center>" . round($row->yearly_yield, 2) . "%</center></td>";
                    echo "<td><center>" . $row->months . "</center></td>";
                    echo "<td><center>$" . round($row->monthly_income, 2) . "</center></td>";
                    echo "<td><center>" . round($row->monthly_yield, 2) . "%</center></td>";
                    echo "</tr>";
                }?>
            </table>

        </div>
    </div>
</div>