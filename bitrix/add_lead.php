<?php
//file_put_contents(__DIR__.'/post.log.txt', print_r($_POST,true), false);

$product_id = '';
if(isset($_POST['product_id']) and !empty($_POST['product_id'])){
    $product_id = $_POST['product_id'];
}else{
    //$product_id = 40;//obratniy zvonok
}

$product = '';
if(isset($_POST['product']) and !empty($_POST['product'])){
    $product = $_POST['product'];
}else{
    $product = '';//obratniy zvonok
}


$price = 1.00;
if(isset($_POST['price']) and !empty($_POST['price'])){
    $price = $_POST['price'];
}

$fio = '';
if(isset($_POST['fio']) and !empty($_POST['fio'])){
    $fio = $_POST['fio'];
}

$phone = '';
if(isset($_POST['phone']) and !empty($_POST['phone'])){
    $phone = $_POST['phone'];
}

//utm
$utm_source = '';
if(isset($_POST['utm_source']) and !empty($_POST['utm_source'])){
    $utm_source = $_POST['utm_source'];
}

$utm_medium = '';
if(isset($_POST['utm_medium']) and !empty($_POST['utm_medium'])){
    $utm_medium = $_POST['utm_medium'];
}

$utm_content = '';
if(isset($_POST['utm_content']) and !empty($_POST['utm_content'])){
    $utm_content = $_POST['utm_content'];
}

$utm_campaign = '';
if(isset($_POST['utm_campaign']) and !empty($_POST['utm_campaign'])){
    $utm_campaign = $_POST['utm_campaign'];
}

$utm_term = '';
if(isset($_POST['utm_term']) and !empty($_POST['utm_term'])){
    $utm_term = $_POST['utm_term'];
}

$message = '';
if(isset($_POST['message']) and !empty($_POST['message'])){
    $message = $_POST['message'];
}

//utm END

$size = '';
if(isset($_POST['size']) and !empty($_POST['size'])){
    $size = (string) trim($_POST['size']);
    $size = str_ireplace('Размер ', '', $size);
    $size = trim($size);
    
    //Определим id в зависимости от размера
    $sizes_to_id = '';
    if(isset($_POST['sizes_to_id']) and !empty($_POST['sizes_to_id'])){
        $sizes_to_id = $_POST['sizes_to_id'];
        //file_put_contents('sizes_to_id.txt', $sizes_to_id);
        $sizes_to_id_arr = json_decode($sizes_to_id, true);
        foreach($sizes_to_id_arr as $s => $id){
            $s = (string) trim($s);
            if($s == $size){
                $product_id = $id;
                //file_put_contents('sizes_to_id_'.$s.'.txt', $id);
            }
        }
    }
}

function wcCurl($queryData, $queryUrl)
{
    $queryData = http_build_query($queryData);
    
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_POST => 1,
        CURLOPT_HEADER => 0,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $queryUrl,
        CURLOPT_POSTFIELDS => $queryData,
    ));
    
    try {
        $product_id = curl_exec($curl);
    }
    catch(Exception $e){
        $info = 'В методе: ' . __FUNCTION__ . ' около строки: ' .  __LINE__ . ' произошла ошибка API: ';
        $err = $info . $e->getMessage();
        $this->file_put_contents(__FUNCTION__ .'_err_log', $err, false);
        return false;
    }
    
    curl_close($curl);
    
    return $product_id;
}

//$product_id = '40';//zakomentit
$queryData = array(
    'product_id' => $product_id,
    'product' => $product,
    'name' => $fio,
    'telephone' => $phone,
    'price' => $price,
    'site' => $_SERVER['HTTP_HOST'],
    'message' => $message,
    'utm_source' => $utm_source,
    'utm_medium' => $utm_medium,
    'utm_content' => $utm_content,
    'utm_campaign' => $utm_campaign,
    'utm_term' => $utm_term
);

$queryUrl = 'https://ad-crew.ru/index.php?route=checkout/add_lp_order';

$result = wcCurl($queryData, $queryUrl);