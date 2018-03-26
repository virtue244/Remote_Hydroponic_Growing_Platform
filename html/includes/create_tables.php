<?php
//Create Table users if doesn't exist
$create_users_table = $db_conn->prepare("CREATE TABLE IF NOT EXISTS users (
id INT(44) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(100) NOT NULL,
user_type VARCHAR(50) NOT NULL,
image VARCHAR(256) NOT NULL,
code VARCHAR(256) NOT NULL,
confirm_code VARCHAR(256) NOT NULL,
status VARCHAR(256) NOT NULL,
email VARCHAR(100) NOT NULL,
password VARCHAR(100) NOT NULL,
password_reset VARCHAR(100) NOT NULL,
timestamp VARCHAR(256) NOT NULL
)");
$create_users_table->execute();
//END Create Table users if doesn't exist

    //Create Table visitors if doesn't exist
$create_visitors_table = $db_conn->prepare("CREATE TABLE IF NOT EXISTS visitors (
id INT(100) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
ip VARCHAR(256) NOT NULL,
timestamp VARCHAR(256) NOT NULL
)");
$create_visitors_table->execute();
//END Create Table visitors if doesn't exist

 //Create Table blog_content if doesn't exist
$create_blog_content_table = $db_conn->prepare("CREATE TABLE IF NOT EXISTS blog_content (
id INT(22) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
post_category VARCHAR(100) NOT NULL,
post_title VARCHAR(256) NOT NULL,
image VARCHAR(150) NOT NULL,
post_author VARCHAR(256) NOT NULL,
post_textual_content longtext NOT NULL,
timestamp VARCHAR(100) NOT NULL
)");
$create_blog_content_table->execute();
//END Create Table blog_content if doesn't exist


 //Create Table branches if doesn't exist
$create_branches_table = $db_conn->prepare("CREATE TABLE IF NOT EXISTS branches (
id INT(22) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
location_name VARCHAR(256) NOT NULL,
image VARCHAR(256) NOT NULL,
textual_content longtext NOT NULL,
last_time_edited_by VARCHAR(256) NOT NULL,
timestamp VARCHAR(100) NOT NULL
)");
$create_branches_table->execute();
//END Create Table branches if doesn't exist


 //Create Table contact_us if doesn't exist
$create_contact_table = $db_conn->prepare("CREATE TABLE IF NOT EXISTS contact (
id INT(22) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
full_name VARCHAR(256) NOT NULL,
address VARCHAR(400) NOT NULL,
mobile_phone VARCHAR(100) NOT NULL,
email VARCHAR(100) NOT NULL,
message_title longtext NOT NULL,
message longtext NOT NULL,
timestamp VARCHAR(256) NOT NULL
)");
$create_contact_table->execute();
//END Create Table contact_us if doesn't exist

 //Create Table content if doesn't exist
$create_our_content_table = $db_conn->prepare("CREATE TABLE IF NOT EXISTS content (
id INT(22) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
title text NOT NULL,
textual_content longtext NOT NULL,
timestamp VARCHAR(256) NOT NULL
)");
$create_our_content_table->execute();
//END Create Table content if doesn't exist


 //Create Table header_links if doesn't exist
$create_header_links_table = $db_conn->prepare("CREATE TABLE IF NOT EXISTS header_links (
id INT(22) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
brand_name VARCHAR(256) NOT NULL,
image VARCHAR(256) NOT NULL,
home VARCHAR(50) NOT NULL,
our_services VARCHAR(100) NOT NULL,
price_list VARCHAR(100) NOT NULL,
our_team VARCHAR(80) NOT NULL,
our_branches VARCHAR(200) NOT NULL,
contact_us VARCHAR(80) NOT NULL,
subscribe VARCHAR(10) NOT NULL,
schedule_pickup VARCHAR(80) NOT NULL,
blog VARCHAR(50) NOT NULL,
sign_in VARCHAR(14) NOT NULL,
contact_mobile_phone VARCHAR(150) NOT NULL,
last_time_edited_by VARCHAR(256) NOT NULL,
timestamp VARCHAR(256) NOT NULL
)");
$create_header_links_table->execute();
//END Create Table header_links if doesn't exist

//Create Table  team if doesn't exist
$create_team_table = $db_conn->prepare("CREATE TABLE IF NOT EXISTS team (
id INT(22) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
image VARCHAR(256) NOT NULL,
first_name VARCHAR(150) NOT NULL,
last_name VARCHAR(150) NOT NULL,
position VARCHAR(150) NOT NULL,
first_social_media_link text NOT NULL,
first_social_media_icon VARCHAR(50) NOT NULL,
second_social_media_link text NOT NULL,
second_social_media_icon VARCHAR(50) NOT NULL,
last_time_edited_by VARCHAR(256) NOT NULL,
timestamp VARCHAR(256) NOT NULL
)");
$create_team_table->execute();
//END Create Table  team if doesn't exist

//Create Table pickup_schedule if doesn't exist
$create_pickup_schedule_table = $db_conn->prepare("CREATE TABLE IF NOT EXISTS pickup_schedule (
id INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
full_name VARCHAR(256) NOT NULL,
street text NOT NULL,
district VARCHAR(256) NOT NULL,
mobile_phone VARCHAR(200) NOT NULL,
alternate_phone VARCHAR(200) NOT NULL,
email VARCHAR(256) NOT NULL,
laundry_quantity longtext NOT NULL,
message_title VARCHAR(200) NOT NULL,
message longtext NOT NULL,
status INT(1) NOT NULL,
pickup_date VARCHAR(256) NOT NULL,
delivery_date VARCHAR(256) NOT NULL,
timestamp VARCHAR(256) NOT NULL
)");
$create_pickup_schedule_table->execute();
//END Create Table pickup_schedule if doesn't exist

//Create Table pickup_schedule_section if doesn't exist
$create_pickup_schedule_section_table = $db_conn->prepare("CREATE TABLE IF NOT EXISTS pickup_schedule_section (
id INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(256) NOT NULL,
image VARCHAR(256) NOT NULL,
textual_content text NOT NULL,
button_text VARCHAR(50) NOT NULL,
last_time_edited_by VARCHAR(256) NOT NULL,
timestamp VARCHAR(256) NOT NULL
)");
$create_pickup_schedule_section_table->execute();
//END Create Table pickup_schedule_section if doesn't exist

//Create Table services if doesn't exist
$create_services_table = $db_conn->prepare("CREATE TABLE IF NOT EXISTS services (
id INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(256) NOT NULL,
image VARCHAR(256) NOT NULL,
textual_content longtext NOT NULL,
last_time_edited_by VARCHAR(256) NOT NULL,
timestamp VARCHAR(256) NOT NULL
)");
$create_services_table->execute();
//END Create Table services if doesn't exist

//Create Table price_list if doesn't exist
$create_price_list_table = $db_conn->prepare("CREATE TABLE IF NOT EXISTS price_list (
id INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
service_title VARCHAR(100) NOT NULL,
item_title VARCHAR(100) NOT NULL,
item VARCHAR(100) NOT NULL,
price_title VARCHAR(100) NOT NULL,
price VARCHAR(100) NOT NULL,
last_time_edited_by VARCHAR(256) NOT NULL,
timestamp VARCHAR(256) NOT NULL
)");
$create_price_list_table->execute();
//END Create Table price_list if doesn't exist

//Create Table slider if doesn't exist
$create_slider_table = $db_conn->prepare("CREATE TABLE IF NOT EXISTS slider (
id INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
indicators INT(200) NOT NULL,
item VARCHAR(11) NOT NULL,
title VARCHAR(200) NOT NULL,
subtitle VARCHAR(200) NOT NULL,
image VARCHAR(200) NOT NULL,
last_time_edited_by VARCHAR(150) NOT NULL,
timestamp VARCHAR(256) NOT NULL
)");
$create_slider_table->execute();
//END Create Table slider if doesn't exist

//Create Table subscribers if doesn't exist
$create_subscribers_table = $db_conn->prepare("CREATE TABLE IF NOT EXISTS subscribers (
id INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(256) NOT NULL,
last_time_edited_by VARCHAR(256) NOT NULL,
timestamp VARCHAR(256) NOT NULL
)");
$create_subscribers_table->execute();
//END Create Table subscribers if doesn't exist

 //Create Table footer if doesn't exist
$create_footer_table = $db_conn->prepare("CREATE TABLE IF NOT EXISTS footer (
about_us_title VARCHAR(100) NOT NULL,
about_us_textual_content VARCHAR(100) NOT NULL,
contact_us VARCHAR(100) NOT NULL,
position_name VARCHAR(100) NOT NULL,
company_name VARCHAR(100) NOT NULL,
physical_address VARCHAR(100) NOT NULL,
street VARCHAR(100) NOT NULL,
city VARCHAR(100) NOT NULL,
country VARCHAR(100) NOT NULL,
mobile_phone VARCHAR(100) NOT NULL,
email VARCHAR(100) NOT NULL,
connect_title VARCHAR(100) NOT NULL,
first_social_media_link VARCHAR(100) NOT NULL,
second_social_media_link VARCHAR(100) NOT NULL,
first_social_media_icon VARCHAR(100) NOT NULL,
second_social_media_icon VARCHAR(100) NOT NULL,
last_time_edited_by VARCHAR(256) NOT NULL,
timestamp VARCHAR(256) NOT NULL
)");
$create_footer_table->execute();
//END Create Table footer if doesn't exist