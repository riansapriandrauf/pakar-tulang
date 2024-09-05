<?php
require_once '../config/koneksi.php';
session_start();
session_unset();
session_destroy();
?>
<script>window.location.href="<?= url() ?>login";</script>