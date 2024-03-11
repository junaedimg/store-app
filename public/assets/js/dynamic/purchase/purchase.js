import { config } from "../../modules/config.js";
import {
  loadMain,
  loadModal,
  validateForm,
  setRequest,
  sendFormData,
} from "../../modules/utilities.js";

$(document).ready(function () {
  class Purchase {
    constructor() {
      console.log("Purchse loaded");
      Purchase.initSelect();
      Purchase.qtyInput();
      Purchase.removeTr();
      Purchase.itemSelected();
      Purchase.purchase();
    }

    static itemSelected() {
      $(document).on(
        "click",
        ".select-purchase-view  ul.options li",
        // visibility stock selected
        function () {
          let stockSelect = $(this).attr("data-select");
          let qty = $(this).attr("data-qty");
          let price = $(this).attr("data-price");
          let prevSelected = $(this)
            .parent()
            .parent()
            .prev()
            .children()
            .eq(1)
            .attr("data-select");
          // set value
          $(this).parent().parent().toggleClass("d-none");
          $(this)
            .parent()
            .parent()
            .prev()
            .children()
            .eq(1)
            .html($(this).html());
          $(this).parent().parent().prev().prev();
          $(this)
            .parent()
            .parent()
            .prev()
            .find("button")
            .eq(1)
            .attr("data-select", stockSelect);
          $(this)
            .parent()
            .parent()
            .prev()
            .find("button")
            .eq(1)
            .attr("data-qty", qty);
          $(this)
            .parent()
            .parent()
            .prev()
            .find("button")
            .eq(1)
            .attr("data-price", price);
          //  enable remove button
          $(this)
            .parent()
            .parent()
            .prev()
            .children()
            .eq(0)
            .removeClass("d-none");
          $(this).parents("tr").addClass("selected-row");

          if (stockSelect != prevSelected) {
            // let notSelected = $("table tr").not($(this).parents().eq(5));
            let notSelected = $("table tr");
            notSelected.each(function () {
              let li = $(this).find("ul li");
              li.each(function (i, e) {
                if (e.getAttribute("data-select") == prevSelected) {
                  e.classList.remove("d-none");
                  e.classList.remove("d-none-selected");
                }
              });
            });

            notSelected.each(function () {
              let li = $(this).find("ul li");
              li.each(function (i, e) {
                if (e.getAttribute("data-select") == stockSelect) {
                  e.classList.add("d-none");
                  e.classList.add("d-none-selected");
                }
              });
            });
          }
          // reset the quantity on the number button
          $(this).parents("td").next().find(".qty").val(1);

          // enable button-number
          $(this)
            .parents()
            .eq(5)
            .find("button.disabled")
            .removeClass("disabled");

          // enable input
          $(this).parents("td").next().find("input").removeAttr("disabled");

          // clone tr to the last row if this the last row
          if ($(this).parents()[5] == $("tr.total").prev()[0]) {
            let trClone = $(".template-tr")
              .clone()
              .removeClass("d-none template-tr");
            trClone.insertBefore($(this).parents(6).find(".total"));
          }
          // udpate transaction
          Purchase.updateTransaction($(this));
        }
      );
    }

    static qtyInput() {
      $(document).on("click", ".purchase .btn-number", function (e) {
        let maxQty = parseInt(
          $(this)
            .parents("td")
            .prev()
            .find("button.select-btn")
            .attr("data-qty")
        );
        let type = $(this).attr("data-type");
        let input = $(this).parents().eq(1).children().eq(1);
        let currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
          if (type == "minus") {
            if (currentVal > 1) {
              input.val(currentVal - 1).change();
            }
          } else if (type == "plus") {
            if (currentVal == maxQty) {
              Swal.fire({
                title: "exceeds stock quantity!",
                icon: "warning",
              });
            } else {
              input.val(currentVal + 1).change();
            }
          }
        }
        // udpate transaction
        Purchase.updateTransaction($(this));
      });

      $(document).on("keydown", ".input-number", function (e) {
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

        // udpate transaction
      });
      $(document).on("keyup", ".input-number", function () {
        // if (/^0/.test($(this).val())) {
        //   $(this).val($(this).val().replace(/^0/, ""));
        // }
        // if ($(this).val() == 0) {
        //   $(this).val(1);
        // }
        let maxQty = parseInt(
          $(this)
            .parents("td")
            .prev()
            .find("button.select-btn")
            .attr("data-qty")
        );
        if (parseInt($(this).val()) > maxQty) {
          $(this).val(maxQty);
          Swal.fire({
            title: "exceeds stock quantity!",
            icon: "warning",
          });
        }
        if (parseInt($(this).val()) == 0 || $(this).val().length === 0) {
          $(this).val(1);
        }
        Purchase.updateTransaction($(this));
      });
    }

    static initSelect() {
      $(document).on("click", ".select-purchase-view .select-btn", function () {
        let isDNone = $(this).parent().next().hasClass("d-none");
        // set all select content d-none
        $(".select-content").addClass("d-none");

        isDNone ? $(this).parent().next().removeClass("d-none") : null;
        $(".select-purchase-view .search input").on("keyup", function () {
          let searchWord = $(this).val().toLowerCase().trim();
          //  serach
          $(this)
            .parent()
            .next()
            .children()
            .each((i, elm) => {
              let strElm = elm.innerText.trim().toLowerCase();
              let isSelected = elm.classList.contains("d-none-selected");
              if (!elm.classList.contains("d-none-selected")) {
                // console.log(elm);
                let search = strElm.startsWith(searchWord);
                !search
                  ? elm.classList.add("d-none")
                  : elm.classList.remove("d-none");
              }
            });
        });
      });
    }

    static removeTr() {
      $(document).on("click", ".remove-tr", function () {
        let selected = $(this).parent().next().attr("data-select");
        let listToEnable = $("li[data-select='" + selected + "']");
        listToEnable.each(function (i, e) {
          let $element = $(this); // Menggunakan $(this) untuk menjaga elemen sebagai objek jQuery
          $element.removeClass("d-none");
          $element.removeClass("d-none-selected");
        });
        $(this).parents().eq(5).remove();
        Purchase.updateTransaction($(this));
      });
    }

    static updateTransaction(elm) {
      let price = parseInt(
        elm.parents("tr").find("button.select-btn").attr("data-price")
      );

      let currQty = parseInt(
        elm.parents("tr").find("input.input-number").val()
      );

      // udpateTransaction
      elm
        .parents("tr")
        .find(".cost")
        .html(
          price.toLocaleString("id-ID", {
            style: "currency",
            currency: "IDR",
          })
        );
      elm
        .parents("tr")
        .find(".sub-total")
        .html(
          (price * currQty).toLocaleString("id-ID", {
            style: "currency",
            currency: "IDR",
          })
        );
      elm
        .parents("tr")
        .find(".sub-total")
        .attr("data-sub-total", price * currQty);
      //
      let total = 0;
      $("table tr.selected-row").each(function (i, e) {
        total += parseInt($(this).find(".sub-total").attr("data-sub-total"));
      });

      // Format angka menjadi mata uang dengan tanda titik sebagai pemisah ribuan
      total = total.toLocaleString("id-ID", {
        style: "currency",
        currency: "IDR",
      }); // Format angka menjadi mata uang dengan tanda titik sebagai pemisah ribuan

      $("#total").text(total); // Setel nilai elemen dengan nilai mata uang yang diformat
    }

    static purchase() {
      $(document).on("click", "#btn-purchase", function () {
        let dataRows = $("table tr.selected-row");
        let purchasingData = [];
        dataRows.each(function () {
          let dataProduct = $(this)
            .find("button[data-select]")
            .attr("data-select");
          let dataQty = $(this).find("input.qty").val();
          let row = {
            no_product: dataProduct,
            qty: dataQty,
          };
          purchasingData.push(row);
        });
       

        if (purchasingData.length == 0) {
          Swal.fire({
            title: "no data selected!",
            text: "add transaction data first",
            icon: "warning",
          });
        } else {
          purchasingData = { data_rows: purchasingData };
          Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, continue!",
          }).then(async (result) => {
            if (result.isConfirmed) {
              let data = await setRequest(
                purchasingData,
                "/purchase/add-transaction",
                "post"
              );
              console.log(data);
              if (data.status == "success") {
                Swal.fire({
                  title: "Yes!",
                  text: "Successful transaction.",
                  icon: "success",
                });
                loadMain("/purchase/index");
              }
            }
          });
        }
      });
    }
    // do
  }
  new Purchase();
});
