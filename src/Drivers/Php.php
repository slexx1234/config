<?php

namespace Slexx\Config\Drivers;

use Slexx\Config\ConfigDriverInterface;

class Php implements ConfigDriverInterface
{
    /**
     * @param string $file
     * @return array
     */
    public static function parse($file)
    {
        return require $file;
    }

    /**
     * @param string $file
     * @param array $data
     * @return void
     */
    public static function write($file, $data)
    {
        file_put_contents($file, "<?php\n\nreturn " . static::varExport($data) . ";\n");
    }

    /**
     * @param array $array
     * @return bool
     */
    protected static function isNumericArray($array)
    {
        $i = 0;
        foreach($array as $key => $value) {
            if ($key !== $i) {
                return false;
            }
            $i++;
        }
        return true;
    }

    /**
     * @param mixed $var
     * @param int $level
     * @param string $indent
     * @return string
     */
    protected static function varExport($var, $level = 0, $indent = '    ')
    {
        if (is_array($var)) {
            $result = '';
            if ($level === 0) {
                $result .= str_repeat($indent, $level);
            }
            $result .= "[\n";
            if (static::isNumericArray($var)) {
                foreach($var as $value) {
                    $result .= str_repeat($indent, $level+1) . static::varExport($value, $level+1) . ",\n";
                }
            } else {
                foreach($var as $key => $value) {
                    $result .= str_repeat($indent, $level+1) . static::varExport($key) . ' => ' . static::varExport($value, $level+1) . ",\n";
                }
            }
            $result .= str_repeat($indent, $level) . "]";
            return $result;
        } else {
            ob_start();
            var_export($var);
            return ob_get_clean();
        }
    }
}
