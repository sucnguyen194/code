<?php
namespace App\Models;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\Traits\LogsActivity;

class Setting extends Model{

    use LogsActivity;

    protected static $logUnguarded = true;
    protected static $submitEmptyLogs = false;
    protected static $logOnlyDirty = true;

    const CREATED_AT = null;
    protected $guarded  = [];
    protected $primaryKey = 'name';
    public $incrementing = false;

    public static $valueCasts = [
        'home.slides.items' => 'object',
        'home.banners' => 'object'
    ];

    public static function add($key, $val, $type = 'string')
    {
        if ( self::has($key) ) {
            return self::set($key, $val, $type);
        }

        if(is_array($val) || is_object($val))
            $val = json_encode($val);

        return self::create(['name' => $key, 'value' => $val, 'type' => $type]) ? $val : false;
    }

    /**
     * Get a settings value
     *
     * @param $key
     * @param null $default
     * @return bool|int|mixed
     */
    public static function get($key, $default = null)
    {
        if ( self::has($key) ) {
            $setting = self::getAllSettings()->where('name', $key)->first();

            $type = array_key_exists($key, self::$valueCasts) ? self::$valueCasts[$key] : $setting->type;

            return self::castValue($setting->value, $type);
        } else {
            $setting = self::where('name', $key)->first();
            if ($setting){
                if ($setting->autoload == 1){
                    self::flushCache();
                    return self::get($key, $default);
                }


                return self::castValue($setting->value, $type);
            }

        }

        return self::getDefaultValue($key, $default);
    }

    /**
     * Set a value for setting
     *
     * @param $key
     * @param $val
     * @param string $type
     * @return bool
     */
    public static function set($key, $val, $type = 'string')
    {

        if ( $setting = self::getAllSettings()->where('name', $key)->first() ) {
            if(is_array($val) || is_object($val))
                $val = json_encode($val);
            return $setting->update([
                'name' => $key,
                'value' => $val]) ? $val : false;
        }

        return self::add($key, $val, $type);
    }

    /**
     * Remove a setting
     *
     * @param $key
     * @return bool
     */
    public static function remove($key)
    {
        if( self::has($key) ) {
            return self::whereName($key)->delete();
        }

        return false;
    }

    /**
     * Check if setting exists
     *
     * @param $key
     * @return bool
     */
    public static function has($key)
    {
        return (boolean) self::getAllSettings()->whereStrict('name', $key)->count();
    }


    /**
     * Get default value for a setting
     *
     * @param $field
     * @return mixed
     */
    public static function getDefaultValueForField($field)
    {
        return self::getDefinedSettingFields()[$field];
    }

    /**
     * Get default value from config if no value passed
     *
     * @param $key
     * @param $default
     * @return mixed
     */
    private static function getDefaultValue($key, $default)
    {
        return is_null($default) ? config('settings.'.$key) : $default;
    }

    /**
     * Get all the settings fields from config
     *
     * @return Collection
     */
    private static function getDefinedSettingFields()
    {
        return config('settings');
    }

    /**
     * caste value into respective type
     *
     * @param $val
     * @param $castTo
     * @return bool|int
     */
    private static function castValue($val, $castTo)
    {

        switch ($castTo) {
            case 'int':
            case 'integer':
                return intval($val);
                break;

            case 'bool':
            case 'boolean':
                return boolval($val);
                break;
            case 'array':
                return json_decode($val,true);
            case 'object':
                return json_decode($val);
            default:
                return $val;
        }
    }

    /**
     * Get all the settings
     *
     * @return mixed
     */
    public static function getAllSettings()
    {

        return Cache::rememberForever('settings.all', function() {
            return self::where('autoload', 1)->get();
            //return collect(json_decode(self::all()->toJson()));
        });
    }

    /**
     * Flush the cache
     */
    public static function flushCache()
    {
        Cache::forget('settings.all');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::updated(function () {
            self::flushCache();

        });

        static::created(function() {
            self::flushCache();
        });
    }

}

?>
