<?php

function generateApiKey($length = 32) {
    return bin2hex(random_bytes($length / 2));
}

echo '<h1>'.generateApiKey().'</h1>';

?>
