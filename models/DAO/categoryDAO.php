<?php
interface categoryDAO {
    public function add($category, $db);
    public static function toAll($db);
}
?>