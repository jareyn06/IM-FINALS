Smart Canteen Ordering System (SCOS)

SIMPLE PHP PDO OOP VERSION

FILES
- index.php
- connection.php
- handler.php
- style.css
- classes/MenuItem.php
- database/catadman_smart_canteen.sql

XAMPP
1. Copy this folder to C:\xampp\htdocs\
2. Start Apache and MySQL
3. Open http://localhost/phpmyadmin
4. Import database/catadman_smart_canteen.sql
5. Open http://localhost/catadman_smart_canteen/

FLOW
Form -> handler.php -> MenuItem object -> PDO query -> MySQL -> index.php

NOTE
This simple version follows the Prelim's CRUD Menu Management feature and the MENU_ITEMS entity from the ERD.
