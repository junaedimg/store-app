// File: Product.js
import {
  loadMain,
  loadModal,
  validateForm,
  setRequest,
  sendFormData,
} from "../../modules/utilities.js";

export class Product {
  static init() {
    Product.openAddProductModal();
    Product.submitProductForm();
    Product.goBackToInventory();
    Product.deleteProduct();
    Product.goToProductPage();
  }

  //
  static goToProductPage() {
    $(document).on("click", "#btn-gt-product", function () {
      loadMain("/manage-inventory/list-product-page").then(function () {
        Product.loadTableProduct();
      });
    });
  }
  //
  static loadTableProduct() {
    let table = $("#table").DataTable({
      columnDefs: [
        {
          targets: 4,
          orderable: false,
        },
        {
          targets: 2,
          orderable: false,
        },
      ],
    });
  }
  //
  static deleteProduct() {
    $(document).on("click", ".btn.delete-product", function () {
      let id = { no_product: $(this).attr("data-id") };
      console.log("clicked");
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then(async (result) => {
        if (result.isConfirmed) {
          let data = await setRequest(
            id,
            "/manage-inventory/delete-product-data",
            "post"
          );
          if (data.status == "success") {
            Swal.fire({
              title: "Deleted!",
              text: "Your file has been deleted.",
              icon: "success",
            });
            loadMain("/manage-inventory/list-product-page").then(function () {
              Product.loadTableProduct();
            });
          }
        }
      });
    });
  }
  //
  static openAddProductModal() {
    $(document).on("click", "#btn-add-product", function () {
      loadModal("/manage-inventory/add-product-page");
    });
  }
  //
  static submitProductForm() {
    $(document).on("click", "#btn-submit-product", async function () {
      const inputs = [
        { id: "#product-name", rule: "1" },
        { id: "#unit", rule: "2" },
        { id: "#price", rule: "2" },
      ];
      // Melakukan validasi untuk setiap nilai
      let isValid = validateForm(inputs);

      // Jika semua data valid, lanjutkan dengan pengiriman data
      if (isValid) {
        const formData = new FormData($("#form-submit")[0]);
        let data = await sendFormData(
          formData,
          "/manage-inventory/add-product-data",
          "post"
        ).then(function (res) {
          if (res.status == "success") {
            loadMain("/manage-inventory/list-product-page").then(function () {
              Product.loadTableProduct();
              Swal.fire({
                title: "Good job!",
                text: "You clicked the button!",
                icon: "success",
              });
              $("#modal").modal("hide");
            });
          }
        });
      }
    });
  }
  //
  static goBackToInventory() {
    $(document).on("click", "#btn-back-inventory", function () {
      loadMain("/manage-inventory/index");
    });
  }
  //
}
