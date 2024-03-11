<?php
$dataStock = $data['data_stock'];
$dataProduct = $data['data_product'];
// $dataUnit = $data["data_unit"];
// pp($dataProduct);
use app\config\config;

?>
<div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Stock</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body edit-stock">

    <form id="form" method="post" class="needs-validation" action="/manage-inventory/add-product-data">
        <table class="table rounded-3 overflow-visible">
            <tr class="border-dark-subtle">
                <th>
                    <label>Product </label>
                </th>
                <td>:</td>
                <td>
                    <input id="no-stock" name="no-stock" type="hidden" value="<?= $dataStock['no_stock']; ?>">
                    <select id="no-product" name="no-product" style="display: none;">
                        <?php
                        foreach ($dataProduct as $value) {
                            if ($value['no_product'] == $dataStock['no_product']) {
                                echo "<option selected value=" . $value['no_product'] . "></option>";
                                $productName = $value['product_name'];
                            }
                            // else {
                            //     echo "<option value=" . $value['no_product'] . "></option>";
                            // }
                        } ?>
                    </select>

                    <div class="select-wrapper w-auto position-relative z-3">
                        <button id="selected" class="select-btn form-control d-inline-flex py-1 px-2 text-decoration-none border rounded-2" type="button"><?= $productName; ?> <i class="uil uil-angle-down"></i></button>
                        <!-- <div id="select-content" class="select-content d-none position-absolute card z-3 w-100">
                            <div class="search">
                                <i class="uil uil-search"></i>
                                <input class="form-control" type="text" placeholder="Search">
                            </div>
                            <ul class="options list-group overflow-y-scroll" style="max-height: 250px;">
                                <?php
                                foreach ($dataProduct as $value) {
                                    echo "<li class=list-group-item data-select =" . $value['no_product'] . ">" . $value['product_name'] . "</li>";
                                } ?>
                            </ul>
                        </div> -->
                    </div>
                    <div class="invalid-feedback"> Please select a unit first</div>
                </td>

            </tr>
            <tr class="border-dark-subtle">
                <th>
                    <label for="qty">Qty </label>
                </th>
                <td>:</td>
                <td>
                    <div>
                        <div class="center">
                            <p></p>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-danger btn-number" data-type="minus">
                                        <span>-</span>
                                    </button>
                                </span>
                                <input id="qty" name="qty" type="text" class="text-center form-control input-number z-2" value="<?= $dataStock['qty'] ?>">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-success btn-number" data-type="plus">
                                        <span>+</span>
                                    </button>
                                </span>
                            </div>
                            <p></p>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>

<div class="modal-footer">
    <button id="btn-edit-stock" class="btn btn-success" type="submit">Update Stock</button>
</div>