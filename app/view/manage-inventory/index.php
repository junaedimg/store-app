<?php
$dataStock = $data;

use app\config\config;
?>
<div class="container-xxl m-0  ">
    <div class="g-col-12 d-flex flex-column gap-2">
        <div>
            <h2>Stock Information</h2>
        </div>
        <div class="g-col-12">
            <button id="btn-gt-add-stock-page" class="btn btn-primary" data-bs-target="#modal" data-bs-toggle="modal">Add Stock</button>
            <button id="btn-gt-product" class="btn btn-warning">Product</button>
        </div>
        <div>
            <table id="table" class="table rounded w-100  ">
                <thead>
                    <tr class="table-primary">
                        <th>
                            No.
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
                            Stock Avaible
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($dataStock as $value) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $value['product_name']; ?></td>
                            <td><?= $value['unit_name']; ?></td>
                            <td>
                                <div class="shadow-lg p-1 bg-body-tertiary rounded overflow-hidden d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                    <?php if ($value['img'] != null) : ?>
                                        <img src="<?= config::BASEURL; ?>/public/uploaded/<?= $value['img']; ?>" style="width: 100%; object-fit: scale-down;">
                                    <?php else : ?>
                                        <i class="fa-regular fa-image fs-2"></i>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td><?= $value['price']; ?></td>
                            <td><?= $value['qty']; ?></td>
                            <td>
                                <button class="btn-gt-edit-stock-page btn btn-warning" data-id=<?= $value['no_stock']; ?> data-bs-target="#modal" data-bs-toggle="modal">
                                    <i class=" fa-regular fa-pen-to-square"></i></button>
                                <button class="btn-delete-stock btn btn-danger" data-id=<?= $value['no_stock']; ?>>
                                    <i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php
                    endforeach
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    // init table
    window.table = $("#table").DataTable({
        columnDefs: [{
                targets: 0,
                orderable: false,
            },
            {
                targets: 5,
                orderable: false,
            },
            {
                targets: 3,
                orderable: false,
            },
        ],
    });
</script>
<script type="module" src="<?= config::BASEURL ?>/public/assets/js/dynamic/manage-inventory/manage-inventory.js">
</script>