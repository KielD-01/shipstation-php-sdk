<?php

namespace KielD01\ShipStation\Models;


use KielD01\ShipStation\Traits\Casts;

/**
 * Class Country
 * @package KielD01\ShipStation\Models
 * @property string countryName
 * @property string iso2
 * @property string iso3
 * @property string topLevelDomain
 * @property string fips
 * @property string isoNumeric
 * @property integer geoNameId
 * @property integer e164
 * @property integer phoneCode
 * @property string continent
 * @property string capital
 * @property string capitalTimeZone
 * @property string currency
 * @property string languageCodes
 * @property string languages
 * @property float area
 * @property integer internetHosts
 * @property integer internetUsers
 * @property integer mobilePhones
 * @property integer landLinePhones
 * @property string gdp
 */
class Country
{

    use Casts;

    /**
     * Country keys list
     *
     * @var array
     */
    private $keys = [
        'countryName',
        'iso2',
        'iso3',
        'topLevelDomain',
        'fips',
        'isoNumeric',
        'geoNameId',
        'e164',
        'phoneCode',
        'continent',
        'capital',
        'capitalTimeZone',
        'currency',
        'languageCodes',
        'languages',
        'area',
        'internetHosts',
        'internetUsers',
        'mobilePhones',
        'landLinePhones',
        'gdp',
    ];

    protected $casts = [
        'geoNameId' => 'int',
        'e164' => 'int',
        'gdp' => 'int',
        'phoneCode' => 'int',
        'area' => 'int',
        'internetHosts' => 'int',
        'internetUsers' => 'int',
        'mobilePhones' => 'int',
        'landLinePhones' => 'int',
    ];

    public function __construct($country = [])
    {

        foreach ($country as $key => $value) {
            $field = $this->keys[$key];

            switch ($field) {
                case 'languageCodes':
                    $this->{$field} = explode(',', $value);
                    break;
                default:
                    $this->{$field} = $value;
                    break;
            }
        }

        $this->cast();
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        $this->{$name} = $value;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->{$name};
    }
}