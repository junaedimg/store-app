<?php
// EXECUTE
use app\config\config;
?>
<div class="container-xxl m-0  ">
    <div class="g-col-12 d-flex flex-column gap-2">
        <div>
            <a id="btn-back-inventory" role="button"><i class="fa-solid fa-caret-left"></i> Back</a>
        </div>
        <div>
            <h2>List Product</h2>
        </div>
        <div>
            <button id="btn-gt-add-product-page" type="buton" class="btn btn-primary text-nowrap" data-bs-target="#modal" data-bs-toggle="modal">
                Tambah Product
            </button>
        </div>
        <div>
            <table id="table" class="table rounded w-100 ">
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
                    $no = 1;
                    // pp($data['data_unit']);
                    foreach ($data["data_product"] as  $value) :
                        if ($value['product_remove'] != 1) :
                    ?>
                            <tr>
                                <td>
                                    <?= $no++; ?>
                                </td>
                                <td>

                                    <?= $value['product_remove']; ?>
                                    <?= $value['product_name']; ?>
                                </td>
                                <td>
                                    <?php
                                    foreach ($data['data_unit'] as $value2) {
                                        if ($value2["id_unit"] == $value["id_unit"]) {
                                            echo $value2['unit_name'];
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <div class="shadow-lg p-1 bg-body-tertiary rounded overflow-hidden d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                        <?php
                                        if ($value['img'] != null) {
                                            // echo '<img src="' . $value["img"] . '" style="width: 100%; object-fit: scale-down;">';
                                            echo '<img src="' . config::BASEURL . '/public/uploaded/' .  $value["img"] . '" style="width: 100%; object-fit: scale-down;">';
                                        } else {
                                            echo '<i class="fa-regular fa-image fs-2"></i>';
                                        }
                                        ?>
                                    </div>
                                </td>
                                <td>
                                    <?= $value['price']; ?>
                                </td>
                                <td>
                                    <button class="btn-gt-edit-product-page btn btn-warning" data-id=<?= $value['no_product']; ?> data-bs-target="#modal" data-bs-toggle="modal">
                                        <i class=" fa-regular fa-pen-to-square"></i></button>
                                    <button class="btn-delete-product btn btn-danger" data-id=<?= $value['no_product']; ?>>
                                        <i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                    <?php
                        endif;
                    endforeach;
                    ?>
                </tbody>
            </table>
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
        </div>
    </div>
</div>