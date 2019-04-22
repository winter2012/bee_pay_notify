<?php
/**
 * Created by PhpStorm.
 * User: Winter
 * Date: 2018/9/29
 * Time: 14:58
 */
include '../config/config.php';

$orderAmount = $_POST['orderAmount'];
$prdOrdNo = $_POST['prdOrdNo'];
$notifyUrl = $_POST['notifyUrl'];

$data = [
    'trade_no'      => "randNumber123456",
    'app_id'        => $merchantId,
    'out_trade_no'  => $prdOrdNo,
    'status'        => "success",
    'way'           => "verify",
    'amount'        => $orderAmount
];

$tmp = "trade_no=$data[trade_no]&app_id=$data[app_id]&out_trade_no=$data[out_trade_no]&status=$data[status]&way=$data[way]&amount=$data[amount]&key=".$signKey;
$data['sign'] = strtolower(md5($tmp));

//发送回调
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $notifyUrl);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$response = curl_exec($ch);
if( curl_errno($ch) ) {
    exit("curl请求异常,错误码:".curl_errno($ch).",错误信息:".curl_error($ch));
}
curl_close($ch);
echo $response;