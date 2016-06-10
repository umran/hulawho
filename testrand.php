<?php

for ($i = 0; $i < 4; $i++) {
    $bytes = openssl_random_pseudo_bytes($i, $cstrong);
    $hex = bin2hex($bytes);
}

print hash('sha256', $hex);

?>
