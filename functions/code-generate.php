<?php
function generateCode() {
    return str_pad(rand(0, 999999), 6, "0", STR_PAD_LEFT);
}

// $code = generateCode();
// echo "Generated code: $code";

?>