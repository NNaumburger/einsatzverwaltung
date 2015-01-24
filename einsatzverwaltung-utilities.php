<?php
namespace abrain\Einsatzverwaltung;

/**
 * Stellt nützliche Helferlein zur Verfügung
 *
 * @author Andreas Brain
 */
class Utilities
{
    /**
     * Hilfsfunktion für Checkboxen, übersetzt 1/0 Logik in Haken an/aus
     *
     * @return bool
     */
    public static function checked($value)
    {
        return ($value == 1 ? 'checked="checked" ' : '');
    }


    /**
     * Prüft, ob WordPress mindestens in Version $ver läuft
     *
     * @param string $ver gesuchte Version von WordPress
     *
     * @return bool
     */
    public static function isMinWPVersion($ver)
    {
        $currentversionparts = explode(".", get_bloginfo('version'));
        if (count($currentversionparts) < 3) {
            $currentversionparts[2] = "0";
        }

        $neededversionparts = explode(".", $ver);
        if (count($neededversionparts) < 3) {
            $neededversionparts[2] = "0";
        }

        if (intval($neededversionparts[0]) > intval($currentversionparts[0])) {
            return false;
        } elseif (intval($neededversionparts[0]) == intval($currentversionparts[0]) &&
                    intval($neededversionparts[1]) > intval($currentversionparts[1])) {
            return false;
        } elseif (intval($neededversionparts[0]) == intval($currentversionparts[0]) &&
                    intval($neededversionparts[1]) == intval($currentversionparts[1]) &&
                    intval($neededversionparts[2]) > intval($currentversionparts[2])) {
            return false;
        }

        return true;
    }


    /**
     * Gibt eine Fehlermeldung aus
     */
    public static function printError($message)
    {
        echo '<p class="evw_error"><i class="fa fa-exclamation-circle"></i>&nbsp;' . $message . '</p>';
    }


    /**
     * Gibt eine Warnmeldung aus
     */
    public static function printWarning($message)
    {
        echo '<p class="evw_warning"><i class="fa fa-exclamation-triangle"></i>&nbsp;' . $message . '</p>';
    }


    /**
     * Gibt eine Erfolgsmeldung aus
     */
    public static function printSuccess($message)
    {
        echo '<p class="evw_success"><i class="fa fa-check-circle"></i>&nbsp;' . $message . '</p>';
    }


    /**
     * Gibt eine Information aus
     */
    public static function printInfo($message)
    {
        echo '<p class="evw_info"><i class="fa fa-info-circle"></i>&nbsp;' . $message . '</p>';
    }


    /**
     * Bereitet den Formularwert einer Checkbox für das Speichern in der Datenbank vor
     */
    public static function sanitizeCheckbox($input)
    {
        if (is_array($input)) {
            $arr = $input[0];
            $index = $input[1];
            $value = (array_key_exists($index, $arr) ? $arr[$index] : "");
        } else {
            $value = $input;
        }

        if (isset($value) && $value == "1") {
            return 1;
        } else {
            return 0;
        }
    }


    /**
     * Stellt sicher, dass eine Zahl positiv ist
     */
    public static function sanitizePositiveNumber($input, $defaultvalue = 0)
    {
        $val = intval($input);
        if (is_numeric($val) && $val >= 0) {
            return $val;
        } else {
            return $defaultvalue;
        }
    }
}