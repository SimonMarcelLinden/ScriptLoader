<?php

namespace SimonMarcelLinden\ScriptLoader;

class ScriptLoader {
    /**
     * @var array
     */
    private $scripts = [];

    /**
     * @var array
     */
    private $styles = [];

    public function __construct() {

    }

    /**
     * @param string $type
     * @description Integrates style sheets and scripts.
     *              The parameter $ type ('script' | 'style' | 'both') can be used to control which output is generated.
     *              The default is both.
     * @return void
     */
    public function load($type = 'both'): void {
        $type = strtolower($type);
        if (in_array($type, ['script', 'style', 'both'])) {
            if( $type == 'style' || $type == 'both') {
                foreach ($this->styles as $style) {
                    $src    = $style["src"];
                    $option = $style['option'];
                    if( (is_array($option) && in_array("inline", $option))) {
                        // Search index of inline
                        $key = array_search('inline', $option);
                        // Remove inline from option array
                        array_splice($option, $key);
                        // Convert array to string
                        $option = implode(",", $option);

                        echo "<style rel='stylesheet' $option>" . $src . "</style>";
                    } elseif('inline' === $option) {
                        echo "<style rel='stylesheet'>" . $src . "</style>";
                    }
                    else {
                        echo "<link href='$src' rel='stylesheet' $option>";
                    }
                }
            }

            if( $type == 'script' || $type == 'both') {
                foreach ($this->scripts as $script) {
                    $src    = $script["src"];
                    $option = $script['option'];
                    if( (is_array($option) && in_array("inline", $option))) {
                        // Search index of inline
                        $key = array_search('inline', $option);
                        // Remove inline from option array
                        array_splice($option, $key);
                        // Convert array to string
                        $option = implode(",", $option);

                        echo "<script type='text/javascript' $option>" . $src . "</script>";
                    } elseif('inline' === $option) {
                        echo "<script type='text/javascript'>" . $src . "</script>";
                    } else {
                        echo "<script src='$src' type='text/javascript' $option></script>";
                    }
                }
            }
        }
    }

    /**
     * @param string $key
     * @param string|null $value
     * @param int $priority
     * @param string|array|null $option
     *
     * @return void
     */
    public function set(string $key, string $value = null, int $priority = 1, $option = null): void {
        $method = 'set'.ucfirst($key);

        if (method_exists($this, $method)) {
            $this->$method($value, $priority, $option);
        }
    }

    /**
     * @param string $script
     * @param int $priority
     * @param string|array|null $option
     *
     * @return void
     */
    private function setScript(string $script, int $priority, $option = null): void {
        $this->scripts[] = ['src' => $script, 'priority' => $priority, 'option' => $option];
        $this->sort($this->scripts);
    }

    /**
     * @param string $style
     * @param int $priority
     * @param string|array|null $option
     *
     * @return void
     */
    private function setStyle(string $style, int $priority, $option = null): void {
        $this->styles[] = ['src' => $style, 'priority' => $priority, 'option' => $option];
        $this->sort($this->styles);
    }

    /**
     * Sort an array by priority
     * @param array $array
     * @param string $key
     *
     * @return void
     */
    private function sort (array &$array, string $key = 'priority'): void{
        $tempArray = $array;
        $length = count( $tempArray ) - 1;

        for ($j = 0; $j < $length; $j++) {
            // Checking the condition for two
            //        // simultaneous elements of the array
            if ($tempArray[$j][$key] > $tempArray[$j + 1][$key]) {
                // Swapping the elements.
                $temp               = $tempArray[$j];
                $tempArray[$j]      = $tempArray[$j + 1];
                $tempArray[$j + 1]  = $temp;

                // updating the value of j = -1
                // so after getting updated for j++
                // in the loop it becomes 0 and
                // the loop begins from the start.
                $j = -1;
            }
        }

        $array = $tempArray;
    }
}
