<?php

namespace Smarrt;

class Dot
{

    const SEPARATOR = '.';

    protected $data;

    private function __construct(array & $data)
    {
        $this->data = &$data;
    }

    public static function with(array & $data)
    {
        return new self($data);
    }

    public function get($key, $default = null)
    {
        $segments = self::parseKey($key);
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
        $segments = self::parseKey($key);
        $current = &$this->data;
        $length = count($segments);

        $i = 0;
        while ($length-- > 0) {
            $k = $segments[$i++];

            if (is_array($current)) {

                if (!array_key_exists($k, $current)) {
                    $current[$k] = [];
                }

                $current = &$current[$k];
            } else {
                $scalarKey = implode('.', array_slice($segments, 0, --$i));
                throw new \InvalidArgumentException(sprintf('invalid key, %s is scalar, expected array', $scalarKey));
            }

        }

        $current = $value;
    }

    public function remove($key)
    {
        $segments = self::parseKey($key);
        $current = &$this->data;
        $length = count($segments);

        while ($length-- > 1) {
            $k = array_shift($segments);

            if (!(is_array($current) && array_key_exists($k, $current))) {
                return;
            }

            $current = &$current[$k];
        }

        if (is_array($current) && array_key_exists($segments[0], $current)) {
            unset($current[$segments[0]]);
        }
    }

    protected static function parseKey($key)
    {
        if ($key === '') {
            return [];
        }

        return explode(self::SEPARATOR, $key);
    }

}