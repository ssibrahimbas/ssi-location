<?php

namespace global;

class Helper {
    public function getValueInBaseOrDefault(mixed $base, string $name, mixed $default)
    {
        if(isset($base[$name])) return $base[$name];
        return $default;
    }
}