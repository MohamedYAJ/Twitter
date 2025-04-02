<?php
 
function db_connect () {
 
    return new PDO("mysql:host=localhost;dbname=twitter", "root", "");


}