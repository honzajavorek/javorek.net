<?php

/**
 * Standard template helpers shipped with Nette Framework.
 *
 * @author     Honza Javorek, http://www.javorek.net/
 * @copyright  Copyright (c) 2008 Jan Javorek
 * @package    Javorek
 */
final class ExtraTemplateHelpers {

	/**
	 * Static class - cannot be instantiated.
	 */
	final public function __construct() {
		throw new LogicException("Cannot instantiate static class " . get_class($this));
	}
	
	/**
	 * Try to load the requested helper.
	 * @param  string  helper name
	 * @return callback
	 */
	public static function loader($helper)
	{
		$callback = callback(__CLASS__, $helper);
        if ($callback->isCallable()) {
            return $callback;
        }
	}
	
	public static function round($n, $precision) {
		return round($n, $precision);
	}
	
	public static function dateAgoInWords($date) {
		if (!$date) {
            return FALSE;
        } elseif (is_numeric($date)) {
            $date = (int) $date;
        } elseif ($date instanceof DateTime) {
            $date = $date->format('U');
        } else {
            $date = strtotime($date);
        }

        $delta = time() - $date;

        if ($delta < 0) {
            $delta = round(abs($delta) / 60);
            if ($delta < 1440) return 'ještě dnes';
            if ($delta < 2880) return 'zítra';
            if ($delta < 43200) return 'za ' . round($delta / 1440) . ' ' . self::plural(round($delta / 1440), 'den', 'dny', 'dní');
            if ($delta < 86400) return 'za měsíc';
            if ($delta < 525960) return 'za ' . round($delta / 43200) . ' ' . self::plural(round($delta / 43200), 'měsíc', 'měsíce', 'měsíců');
            if ($delta < 1051920) return 'za rok';
            return 'za ' . round($delta / 525960) . ' ' . self::plural(round($delta / 525960), 'rok', 'roky', 'let');
        }

        $delta = round($delta / 60);
        if ($delta < 1440) return 'dnes';
        if ($delta < 2880) return 'včera';
        if ($delta < 43200) return 'před ' . round($delta / 1440) . ' dny';
        if ($delta < 86400) return 'před měsícem';
        if ($delta < 525960) return 'před ' . round($delta / 43200) . ' měsíci';
        if ($delta < 1051920) return 'před rokem';
        return 'před ' . round($delta / 525960) . ' lety';
	}
	
	public static function timeAgoInWords($time) {
        if (!$time) {
            return FALSE;
        } elseif (is_numeric($time)) {
            $time = (int) $time;
        } elseif ($time instanceof DateTime) {
            $time = $time->format('U');
        } else {
            $time = strtotime($time);
        }

        $delta = time() - $time;

        if ($delta < 0) {
            $delta = round(abs($delta) / 60);
            if ($delta == 0) return 'za okamžik';
            if ($delta == 1) return 'za minutu';
            if ($delta < 45) return 'za ' . $delta . ' ' . self::plural($delta, 'minuta', 'minuty', 'minut');
            if ($delta < 90) return 'za hodinu';
            if ($delta < 1440) return 'za ' . round($delta / 60) . ' ' . self::plural(round($delta / 60), 'hodina', 'hodiny', 'hodin');
            if ($delta < 2880) return 'zítra';
            if ($delta < 43200) return 'za ' . round($delta / 1440) . ' ' . self::plural(round($delta / 1440), 'den', 'dny', 'dní');
            if ($delta < 86400) return 'za měsíc';
            if ($delta < 525960) return 'za ' . round($delta / 43200) . ' ' . self::plural(round($delta / 43200), 'měsíc', 'měsíce', 'měsíců');
            if ($delta < 1051920) return 'za rok';
            return 'za ' . round($delta / 525960) . ' ' . self::plural(round($delta / 525960), 'rok', 'roky', 'let');
        }

        $delta = round($delta / 60);
        if ($delta == 0) return 'před okamžikem';
        if ($delta == 1) return 'před minutou';
        if ($delta < 45) return "před $delta minutami";
        if ($delta < 90) return 'před hodinou';
        if ($delta < 1440) return 'před ' . round($delta / 60) . ' hodinami';
        if ($delta < 2880) return 'včera';
        if ($delta < 43200) return 'před ' . round($delta / 1440) . ' dny';
        if ($delta < 86400) return 'před měsícem';
        if ($delta < 525960) return 'před ' . round($delta / 43200) . ' měsíci';
        if ($delta < 1051920) return 'před rokem';
        return 'před ' . round($delta / 525960) . ' lety';
	}
	
	public static function microformat($val, $type) {
		switch ($type) {
			case 'date':
				$val = (preg_match('~^\\d+$~', $val))? $val : strtotime($val);
				return date('Y-m-d', $val);
				break;
			case 'datetime':
				$val = (preg_match('~^\\d+$~', $val))? $val : strtotime($val);
				return strftime('%Y-%m-%dT%H:%M:%SZ', $val);
				break;
			default:
				throw new NotImplementedException('Not implemented.');
		}
	}
	
	/**
     * Plural: three forms, special cases for 1 and 2, 3, 4.
     * (Slavic family: Slovak, Czech)
     * 
     * @param  int
     * @return mixed
     */
    public static function plural($n) {
        $args = func_get_args();
        return $args[($n == 1) ? 1 : (($n >= 2 && $n <= 4) ? 2 : 3)];
    }
    
    /**
     * Email obfuscation
     * 
     * @param string $email
     * @param bool $heavy
     * @return string HTML
     */
    public static function email($email, $heavy = FALSE) {
    	return String::replace($email, '#@#', ($heavy)? '&#64;<!---->' : '&#64;');
    }
    
	/**
     * Phone formatting
     * 
     * @param string $phone
     * @return string
     */
    public static function phone($phone) {
    	return trim(String::replace($phone, '#\\+?\\d{3}#', '\\0 '));
    }
    
    /**
     * Google Translate link.
     * 
     * @param string $link
     * @param string $from
     * @param string $to
     */
    public static function gtranslate($link, $from, $to) {
    	$link = rawurlencode($link);
    	return "http://translate.google.com/translate?sl=$from&tl=$to&u=$link";
    }
    
    /**
     * Helper for translations. Replaces hashed words with values.
     * 
     * @param string $text
     * @param string $hash
     * @param string $value
     */
    public static function inject($text, $hash, $value) {
    	return String::replace($text, "#\\#$hash#", $value);
    }
    
}
