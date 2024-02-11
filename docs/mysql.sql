CREATE TABLE `role` (
  `id_role` integer PRIMARY KEY,
  `role_name` varchar(255)
);

CREATE TABLE `user` (
  `id_user` integer PRIMARY KEY,
  `name` varchar(255),
  `id_role` int
);

CREATE TABLE `unit` (
  `id_unit` integer PRIMARY KEY,
  `unit_name` varchar(255)
);

CREATE TABLE `product` (
  `no_product` integer PRIMARY KEY,
  `nama_product` varchar(255),
  `id_unit` integer,
  `img` varchar(255),
  `price` int,
  `product_remove` bool
);

CREATE TABLE `stock` (
  `no_stock` integer PRIMARY KEY,
  `no_product` int,
  `amount` int,
  `price` int
);

CREATE TABLE `stock_added` (
  `no_stock_added` int PRIMARY KEY,
  `id_user` int,
  `date` date
);

CREATE TABLE `stock_details_added` (
  `no_stock_details_added` int,
  `no_product` int,
  `amount` int,
  `price` int
);

CREATE TABLE `transaction` (
  `no_transaction` int PRIMARY KEY,
  `id_user` int,
  `date` date
);

CREATE TABLE `transaction_details` (
  `no_transaction_details` int,
  `no_product` int,
  `amount` int,
  `price` int
);

ALTER TABLE `user` ADD FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);

ALTER TABLE `product` ADD FOREIGN KEY (`id_unit`) REFERENCES `unit` (`id_unit`);

ALTER TABLE `stock` ADD FOREIGN KEY (`no_product`) REFERENCES `product` (`no_product`);

ALTER TABLE `stock_added` ADD FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

ALTER TABLE `stock_details_added` ADD FOREIGN KEY (`no_stock_details_added`) REFERENCES `stock_added` (`no_stock_added`);

ALTER TABLE `transaction_details` ADD FOREIGN KEY (`no_transaction_details`) REFERENCES `transaction` (`no_transaction`);

ALTER TABLE `transaction` ADD FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
