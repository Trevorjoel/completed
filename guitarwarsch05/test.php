<?php

$message = "test mail body";
$headers = "From: trevor";
mail("trevsstuff@hotmail.com","Testing","$message", "$headers");
echo "the message has been sent"
?>