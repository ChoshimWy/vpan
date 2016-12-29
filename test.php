<?php function getMillisecond()
{
    list($t1, $t2) = explode(' ', microtime());
    return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
}
    echo getMillisecond();
    echo "<br />";
    echo time();
    echo "<br />";
    echo getMillisecond();
