-- Database: 'college'




CREATE TABLE `college`.`users` 
(`user_id` INT(20) NOT NULL , 
`user_name` VARCHAR(50) NOT NULL ,
 `user_email` VARCHAR(100) NOT NULL ,
  `user_phn` VARCHAR(20) NOT NULL , 
  `user_password` VARCHAR(100) NOT NULL ,
   PRIMARY KEY (`user_email`),
    UNIQUE `UNIQUE` (`user_id`)) ENGINE = InnoDB;


CREATE TABLE `college`.`product` 
(`product_id` INT(10) NOT NULL AUTO_INCREMENT ,
 `product_type` VARCHAR(50) NOT NULL ,
  `product_title` VARCHAR(300) NOT NULL ,
   `product_details` VARCHAR(500) NOT NULL ,
    `product_more_details` TEXT NOT NULL ,
     `product_price` INT(15) NOT NULL ,
      `product_image` VARCHAR(100) NOT NULL ,
       `product_date` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP ,
        PRIMARY KEY (`product_id`)) ENGINE = InnoDB;


-- INSERT INTO `product` 
-- (`product_id`, `product_type`, `product_title`, `product_details`, `product_more_details`, `product_price`, `product_image`, `product_date`) 
-- VALUES (NULL, 'dc', 'sgdh', 'tdyf', 'gdh', '345', 'hfjg', current_timestamp());


CREATE TABLE `college`.`cart` 
(`cart_id` INT(10) NOT NULL AUTO_INCREMENT ,
 `product_id` INT(10) NOT NULL , 
 `user_email` VARCHAR(50) NOT NULL ,
  `product_title` VARCHAR(300) NOT NULL ,
   `product_price` INT(10) NOT NULL ,
    `product_details` VARCHAR(500) NOT NULL ,
     `product_image` VARCHAR(100) NOT NULL ,
      `product_quantity` INT(10) NOT NULL , 
      PRIMARY KEY (`cart_id`)) ENGINE = InnoDB;

-- INSERT INTO `cart`
--  (`cart_id`, `product_id`, `user_email`, `product_title`, `product_price`, `product_details`, `product_image`, `product_quantity`)
--   VALUES (NULL, '9', 'adf', 'gdfg', '45', 'bn', 'bgn', '2');

CREATE TABLE `college`.`wishlist` 
(`wishlist_id` INT(100) NOT NULL AUTO_INCREMENT , 
`user_email` VARCHAR(100) NOT NULL ,
 `product_id` INT(100) NOT NULL , 
 PRIMARY KEY (`wishlist_id`)) ENGINE = InnoDB;

--  SELECT * FROM `wishlist` left JOIN `product` ON wishlist.product_id = product.product_id;



CREATE TABLE `college`.`order` 
(`order_id` INT(10) NOT NULL AUTO_INCREMENT ,
 `user_email` VARCHAR(100) NOT NULL , 
 `phone` VARCHAR(20) NOT NULL ,
  `name` VARCHAR(50) NOT NULL ,
   `area` VARCHAR(100) NOT NULL ,
    `city` VARCHAR(20) NOT NULL ,
     `state` VARCHAR(20) NOT NULL ,
      `pincode` INT(10) NOT NULL ,
       `landmark` VARCHAR(100) NOT NULL ,
        `totalorder_price` INT(10) NOT NULL ,
         `order_status` VARCHAR(20) NOT NULL ,
          `payment_type` VARCHAR(10) NOT NULL ,
           `payment_status` VARCHAR(15) NOT NULL ,
            `order_date` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP ,
             PRIMARY KEY (`order_id`)) ENGINE = InnoDB;


CREATE TABLE `college`.`orderdetails`
 (`orderdetails_id` INT(10) NOT NULL AUTO_INCREMENT ,
  `order_id` INT(10) NOT NULL ,
   `product_id` INT(10) NOT NULL ,
    `product_quantity` INT(10) NOT NULL 
     `product_price` INT(15) NOT NULL ,
      `product_title` VARCHAR(200) NOT NULL ,
       `product_details` VARCHAR(300) NOT NULL ,
       `product_image` VARCHAR(100) NOT NULL,
        PRIMARY KEY (`orderdetails_id`)) ENGINE = InnoDB;

        SELECT o.order_id,o.name,o.order_status,o.payment_status,od.product_id,od.product_title,od.product_price from `order` o join orderdetails od on o.order_id = od.order_id;