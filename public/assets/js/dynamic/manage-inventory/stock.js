import {
  loadMain,
  loadModal,
  validateForm,
  setRequest,
  sendFormData,
} from "../../modules/utilities.js";

export class Stock {
  static init() {
    Stock.openAddStockModal();
    Stock.initSelect();
    Stock.addStock();
    Stock.deleteStock();
    Stock.openEditStockModal();
    Stock.editStock();
    Stock.loadTableStock();
  }

  static loadTableStock() {
    console.log("loadTable");
    let table = $(".add-stock #table")
      .DataTable
      //   {
      //   columnDefs: [
      //     {
      //       targets: 0,
      //       orderable: false,
      //     },
      //     {
      //       targets: 5,
      //       orderable: false,
      //     },
      //     {
      //       targets: 3,
      //       orderable: false,
      //     },
      //   ],
      // }
      ();
  }
  static openAddStockModal() {
    $(document).on("click", "#btn-gt-add-stock-page", async function () {
      await loadModal("/manage-inventory/add-stock-page").then(function () {
        // define liveSearch Select
        // handle qty input
        $(document).ready(function () {
          $(".add-stock .btn-number").click(function (e) {
            var type = $(this).attr("data-type");
            var input = $(".add-stock input.input-number");
            var currentVal = parseInt(input.val());
            if (!isNaN(currentVal)) {
              if (type == "minus") {
                if (currentVal > 1) {
                  input.val(currentVal - 1).change();
                }
              } else if (type == "plus") {
                input.val(currentVal + 1).change();
              }
            }
          });
          $(".add-stock .input-number").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if (
              $.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
              // Allow: Ctrl+A
              (e.keyCode == 65 && e.ctrlKey === true) ||
              // Allow: home, end, left, right
              (e.keyCode >= 35 && e.keyCode <= 39)
            ) {
              // let it happen, don't do anything
              return;
            }
            // Ensure that it is a number and stop the keypress
            if (
              (e.shiftKey || e.keyCode < 48 || e.keyCode > 57) &&
              (e.keyCode < 96 || e.keyCode > 105)
            ) {
              e.preventDefault();
            }
          });
          $(".add-stock .input-number").keyup(function () {
            if (/^0/.test($(this).val())) {
              $(this).val($(this).val().replace(/^0/, ""));
            }
            if ($(this).val() == 0) {
              $(this).val(1);
            }
          });
        });
      });
    });
  }
  // select true value from div select
  static initSelect() {
    $(document).on("click", ".select-wrapper-stock .select-btn", function () {
      console.log("click");
      $(".add-stock .select-content").toggleClass("d-none ");
      $(".add-stock .search input").on("keyup", function () {
        let searchWord = $(this).val().trim().toLowerCase();
        $(".add-stock ul.options li").each((i, elm) => {
          let strElm = elm.innerText.trim().toLowerCase();
          let selected = strElm.startsWith(searchWord);
          !selected
            ? elm.classList.add("d-none")
            : elm.classList.remove("d-none");
        });
      });
    });
    // set true select value
    $(document).on("click", ".select-wrapper-stock ul.options li", function () {
      $(".add-stock .select-wrapper-stock .select-content").toggleClass(
        "d-none"
      );
      $(".add-stock .select-wrapper-stock .select-btn").html($(this).html());
      $(".add-stock #no-product").val($(this).attr("data-select"));
      let data = new FormData($(".add-stock #form")[0]);
      for (var pair of data.entries()) {
        // console.log(pair[0] + ", " + pair[1]);
      }
    });
  }

  static addStock() {
    $(document).on("click", "#btn-add-stock", async function () {
      console.log("click");
      const inputs = [
        { id: "#no-product", rule: "2" },
        { id: "#qty", rule: "2" },
      ];
      console.log(inputs);
      // // Melakukan validasi untuk setiap nilai
      let isValid = validateForm(inputs);
      // // Jika semua data valid, lanjutkan dengan pengiriman data
      if (isValid) {
        const formData = new FormData($(".add-stock #form")[0]);
        let data = await sendFormData(
          formData,
          "/manage-inventory/add-stock-data",
          "post"
        ).then(function (res) {
          if (res.status == "success") {
            loadMain("/manage-inventory/index").then(function () {
              Swal.fire({
                title: "Good job!",
                text: "You clicked the button!",
                icon: "success",
              });
              $(" #modal").modal("hide");
            });
          }
        });
      }
    });
  }

  static deleteStock() {
    $(document).on("click", ".btn-delete-stock", function () {
      let id = { no_stock: $(this).attr("data-id") };
      console.log(id);
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
            "/manage-inventory/delete-stock-data",
            "post"
          );
          if (data.status == "success") {
            Swal.fire({
              title: "Deleted!",
              text: "Your file has been deleted.",
              icon: "success",
            });
            loadMain("/manage-inventory/index").then(function () {
              // Product.loadTableProduct();
            });
          }
        }
      });
    });
  }
  static openEditStockModal() {
    $(document).on("click", ".btn-gt-edit-stock-page", async function () {
      console.log("clicked");
      await loadModal("/manage-inventory/edit-stock-page", {
        id: $(this).attr("data-id"),
      }).then(function () {
        $(document).ready(function () {
          $(".edit-stock .btn-number").click(function (e) {
            var type = $(this).attr("data-type");
            var input = $(".edit-stock input.input-number");
            var currentVal = parseInt(input.val());
            if (!isNaN(currentVal)) {
              if (type == "minus") {
                if (currentVal >= 1) {
                  input.val(currentVal - 1).change();
                }
              } else if (type == "plus") {
                input.val(currentVal + 1).change();
              }
            }
          });
          $(".edit-stock .input-number").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if (
              $.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
              // Allow: Ctrl+A
              (e.keyCode == 65 && e.ctrlKey === true) ||
              // Allow: home, end, left, right
              (e.keyCode >= 35 && e.keyCode <= 39)
            ) {
              // let it happen, don't do anything
              return;
            }
            // Ensure that it is a number and stop the keypress
            if (
              (e.shiftKey || e.keyCode < 48 || e.keyCode > 57) &&
              (e.keyCode < 96 || e.keyCode > 105)
            ) {
              e.preventDefault();
            }
          });
          $(".edit-stock .input-number").keyup(function () {
            // if (/^0/.test($(this).val())) {
            //   $(this).val($(this).val().replace(/^0/, ""));
            // }
            // if ($(this).val() == 0) {
            //   $(this).val(1);
            // }
          });
        });
      });
    });
  }
  //
  static editStock() {
    $(document).on("click", "#btn-edit-stock", async function () {
      const inputs = [
        { id: "#no-stock", rule: "2" },
        { id: "#no-product", rule: "2" },
        { id: "#qty", rule: "2" },
      ];
      // // Melakukan validasi untuk setiap nilai
      let isValid = validateForm(inputs);
      // // Jika semua data valid, lanjutkan dengan pengiriman data
      if (isValid) {
        const formData = new FormData($(".edit-stock #form")[0]);
        let data = await sendFormData(
          formData,
          "/manage-inventory/edit-stock-data",
          "post"
        ).then(function (res) {
          if (res.status == "success") {
            loadMain("/manage-inventory/index").then(function () {
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
}
