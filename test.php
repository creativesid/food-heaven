<?php

$conn = mysqli_connect("localhost","root","","zzz");

$order_array = array(
    "0"=> array('item'=>"mobile",'qty'=>"1",'price'=>"5000"),
    "1"=> array('item'=>"laptop",'qty'=>"2",'price'=>"50000"),
);
print_r($order_array);

function insert_array($array,$conn){
    if(is_array($array)){
        foreach($array as $row=> $value){
            echo $value['item'];
            $item_name = $value['item'];
            $item_qty = $value['qty'];
            $item_price = $value['price'];
            $sql = "INSERT INTO cart(item_name,qty,item_price) VALUES('$item_name','$item_qty','$item_price')";
            mysqli_query($conn,$sql);
        }
    }
}

insert_array($order_array,$conn);

?>