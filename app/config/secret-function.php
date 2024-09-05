<?php
function code(){
    return "HALO NAMA SAYA ABDUL JABAL";
}

function encrypt($id){
    $data = base64_encode($id.code());
    return $data;
}

function decrypt($id){
    $kode = base64_decode($id);
    $data = str_replace(code(),"", $kode);
    return $data;
}
?>