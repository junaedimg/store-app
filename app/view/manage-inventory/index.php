<?php

use app\config\config;
?>
<div class="container-xxl m-0  ">
    <div class="g-col-12 d-flex flex-column gap-2">
        <div>
            <h2>Stock Information</h2>
        </div>
        <div class="g-col-12">
            <button id="btn-stock" class="btn btn-primary">Tambah Stock</button>
            <button id="btn-gt-product" class="btn btn-warning">Product</button>
        </div>
        <div>
            <table class="table rounded ">
                <thead>
                    <tr class="table-primary">
                        <th>
                            No
                        </th>
                        <th>
                            Product Name
                        </th>
                        <th>
                            Unit
                        </th>
                        <th>
                            Image
                        </th>
                        <th>
                            Price
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="module" src="<?= config::BASEURL ?>/public/assets/js/dynamic/manage-inventory/manage-inventory.js">
</script>