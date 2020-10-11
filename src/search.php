<?php
print_r($_POST);
if(isset($_GET['filter'])) {
    var_dum($_GET["filter"]);
    //$keywords = $db->escape_string($_GET['filter']);
    //$query = $db->query("SELECT title, description, price FROM products WHERE '%{filter}%' LIKE '%{filter}%' ");
}
