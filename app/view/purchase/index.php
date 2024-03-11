<?php

$dataStock = $data["data_stock"];
$dataProduct = $data["data_product"];
$dataUnit = $data["data_unit"];

// pp($dataStock);

use app\config\config;
// var_dump($dataProduct);
?>


<div class="container-xxl m-0 purchase">
    <div>
        <h3>Transaction</h3>
    </div>
    <div class="mt-3">
        <table id="table" class="table rounded overflow-visible">
            <thead class="">
                <tr class="table-primary ">
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Cost(Per Item)</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <!-- template rows -->
                <tr class="template-tr d-none">
                    <td class="w-25">
                        <div class="select-purchase-view">
                            <div class="w-auto position-relative">
                                <div class="btn-wrapper d-flex">
                                    <div class="d-none">
                                        <button class="btn btn-danger remove-tr">
                                            <i class="fa-regular fa-square-minus"></i>
                                        </button>
                                    </div>
                                    <button class="position-relative z-0  select-btn form-control d-inline-flex py-1 px-2 text-decoration-none border rounded-2  d-flex justify-content-between" type="button">
                                        Select Product
                                    </button>
                                </div>
                                <div class="select-content position-absolute z-1 select-content d-none  card  w-100">
                                    <div class="search">
                                        <i class="uil uil-search"></i>
                                        <input class="form-control" type="text" placeholder="Search">
                                    </div>
                                    <ul class="options list-group overflow-y-scroll" style="max-height: 250px;">
                                        <?php
                                        foreach ($dataStock as $stock) {
                                            foreach ($dataProduct as $product) {
                                                if ($product['no_product'] == $stock['no_product']) {
                                                    echo "<li class=list-group-item data-qty=" . $stock['qty'] . " data-price=" . $product['price'] . " data-select =" . $stock['no_product'] . ">" . $product['product_name'] . "</li>";
                                                }
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="w-25">
                        <div>
                            <div class="center">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" class="disabled btn btn-danger btn-number" data-type="minus">
                                            <span>-</span>
                                        </button>
                                    </span>
                                    <input name="qty" type="text" class="qty text-center form-control input-number z-2 " min="1" value="1" disabled>
                                    <span class="input-group-btn">
                                        <button type="button" class="disabled btn btn-success btn-number" data-type="plus">
                                            <span>+</span>
                                        </button>
                                    </span>
                                </div>
                                <p></p>
                            </div>
                        </div>
                    </td>
                    <td class="w-25"><label class="cost form-control disabled bg-body-secondary">-</label></td>
                    <td class="w-25"><label class="sub-total form-control disabled bg-body-secondary">-</label></td>
                </tr>
                <!-- data rows -->

                <!-- Tambahkan baris untuk item lainnya di sini -->
                <tr class="total">
                    <td class="bg-transparent border-0"></td>
                    <td class="bg-transparent border-0"></td>
                    <td class="table-primary fw-bolder"><label for="" class=" ">Total :</label></td>
                    <td><label id="total" class="form-control disabled bg-body-secondary">200000</label></td>
                </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-end px-2 gap-2">
            <button id="btn-purchase" class="btn btn-primary">Purchase</button>
            <button id="btn-reset-purchase" class="btn btn-secondary">Reset</button>
        </div>
    </div>
</div>
<script>
    // init table , clone table
    $(".template-tr")
        .eq(0)
        .after(
            $(".template-tr").eq(0).clone().removeClass("template-tr d-none")
        );
</script>
<script type="module" src="<?= config::BASEURL ?>/public/assets/js/dynamic/purchase/purchase.js">
</script>