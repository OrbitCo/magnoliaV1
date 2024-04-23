<?php

$route["store/([\pL\pN\pM\pZ,'\!\@\^\&\*\(\)\+\-\!\/_=:\.]*)/([\pL\pN\pM\pZ,'\!\@\^\&\*\(\)\+\-\!\/_=:\.]*)-([\pL\pN\pM\pZ,'\!\@\^\&\*\(\)\+\-\!\/_=:\.]+)"]="store/product/gid:$3";
$route["store/category-([\pL\pN\pM\pZ,'\!\@\^\&\*\(\)\+\-\!\/_=:\.]+)"]="store/category/gid:$1";
$route["store/preorder-([\pL\pN\pM\pZ,'\!\@\^\&\*\(\)\+\-\!\/_=:\.]+)"]="store/preorder/code:$1";
$route["store/order-([\pL\pN\pM\pZ,'\!\@\^\&\*\(\)\+\-\!\/_=:\.]+)"]="store/order/code:$1";
$route["admin/marketing/index/"]="admin/intercom/index";
$route["admin/marketing/index/google"]="admin/intercom/index/google";
$route["admin/marketing/index/intercom"]="admin/intercom/index/intercom";
