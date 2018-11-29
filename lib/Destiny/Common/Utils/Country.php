<?php
namespace Destiny\Common\Utils;

use Destiny\Common\Application;
use Destiny\Common\Exception;

/**
 * This class is weird
 */
abstract class Country {
    
    /**
     * List of countries e.g.
     * [{"name":"Afghanistan","alpha-2":"AF","country-code":"004"},...] countries
     *
     * @var array
     */
    public static $countries = [];
    
    /**
     * List of countries by code e.g.
     * {"AF":"Afghanistan"} countries
     *
     * @var array
     */
    public static $codeIndex = null;

    /**
     * Return a cached list of countries
     *
     * @return array
     */
    public static function getCountries() {
        if (self::$countries == null) {
            $cacheDriver = Application::getNsCache();
            $countries = $cacheDriver->fetch ( 'geodata' );
            if (empty ( $countries )) {
                $countries = json_decode ( file_get_contents ( _BASEDIR . '/assets/countries.json' ), true );
                $cacheDriver->save ( 'geodata', $countries );
            }
            if (is_array ( $countries )) {
                self::$countries = $countries;
            }
        }
        if (empty ( self::$codeIndex )) {
            foreach ( self::$countries as $i => $country ) {
                self::$codeIndex [strtolower ( $country ['alpha-2'] )] = $i;
            }
        }
        return self::$countries;
    }

    /**
     * Return a country by code, if none exists throw an exception
     * @param $code
     * @return mixed|null
     * @throws Exception
     */
    public static function getCountryByCode($code) {
        $code = strtolower($code);
        if (!isset (self::$codeIndex [$code])) {
            throw new Exception ('Invalid country');
        }
        return self::getCountries()[self::$codeIndex[$code]];
    }

}