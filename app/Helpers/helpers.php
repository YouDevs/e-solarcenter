<?php

// En tu archivo helper (por ejemplo, app/Helpers/FormatHelper.php)
function formattedAmount($amount)
{
    $formatted_amount = number_format($amount, 2);

    list($amount_whole, $amount_decimal) = explode('.', $formatted_amount);

    return ['whole' => $amount_whole, 'decimal' => $amount_decimal];
}