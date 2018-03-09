<?php
function my_vlaidation_rule()
{
       $rule="text";
        return $rule;
}

// random_element() is included in Array Helper, so it overrides the native function
function random_element($array)
{
        shuffle($array);
        return array_pop($array);
}

?>