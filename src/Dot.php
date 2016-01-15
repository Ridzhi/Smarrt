<?php

namespace Smarrt;

class Dot
{

    const SEPARATOR = '.';

    protected $data;

    private function __construct(array $data)
    {
        $this->data = $data;
    }

    public static function with(array &$data)
    {
        return new self($data);
    }

    public function get($key, $default = null)
    {
        $segments = explode(self::SEPARATOR, $key);
        $current = $this->data;

        $length = count($segments);
        while ($length-- > 0) {
            $k = array_shift($segments);

            if (is_array($current) && array_key_exists($k, $current)) {
                $current = $current[$k];
            } else {
                return $default;
            }
        }

        return $current;
    }


    public function set($key, $value)
    {

    }

    public function has($key)
    {

    }

    public function remove()
    {

    }

}