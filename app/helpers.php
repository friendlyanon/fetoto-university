<?php

use Illuminate\Support\HtmlString;

if (! function_exists('js_module')) {
    /**
     * Signal to the async JS module loader which module should be loaded for
     * this page. The last module defined will be loaded, or if none were
     * defined, then the loader will emit a warning in the console. You may call
     * this function with no parameters to silence the warning and load nothing.
     *
     * @param string|null $moduleName Filename without extension from the
     * resources/js/pages folder
     * @return HtmlString
     */
    function js_module($moduleName = null)
    {
        return new HtmlString(<<<HTML
<script>window.moduleToLoad = "$moduleName";</script>
HTML
        );
    }
}

if (! function_exists('as_route')) {
    /**
     * @param string $controllerClass
     * @param string|null $methodName
     * @return string
     */
    function as_route($controllerClass, $methodName = null)
    {
        if (($pos = strrpos($controllerClass, '\\')) !== false) {
            $controllerClass = substr($controllerClass, $pos + 1);
        }
        return is_string($methodName) ?
            "$controllerClass@$methodName" :
            $controllerClass;
    }
}

if (! function_exists('object_pluck')) {
    /**
     * @param array|object $object
     * @param array|string $keys
     * @return array
     */
    function object_pluck($object, $keys)
    {
        $result = [];

        foreach ((array)$keys as $key) {
            $result[$key] = data_get($object, $key);
        }

        return $result;
    }
}
