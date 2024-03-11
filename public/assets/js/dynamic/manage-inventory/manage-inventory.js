import { Product } from "./product.js";
import { Stock } from "./stock.js";
console.log(" ! manage-inventory loadeddd");


 
$(document).ready(function () {
  // Product Class
  Product.init();
  // Stock Class
  Stock.init();
});
