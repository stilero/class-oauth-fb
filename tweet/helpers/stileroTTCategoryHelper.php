<?php
/**
 * StileroTTCategory
 * Class for handling Category methods
 *
 * @version  1.0
 * @package Stilero
 * @subpackage plg_twittertweet
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2013-aug-12 Stilero Webdesign (http://www.stilero.com)
 * @license	GNU General Public License version 2 or later.
 * @link http://www.stilero.com
 */

// no direct access
defined('_JEXEC') or die('Restricted access'); 

class StileroTTCategoryHelper{
    
    /**
     * Returns the Category Alias from the category id
     * @param int $catid
     * @return string Category Alias
     */
    public static function aliasFromID($catid){
        jimport( 'joomla.filter.output' );
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('c.alias');
        $query->from('#__categories AS c');
        $query->where('c.id='.(int)$catid);
        $db->setQuery($query);
        $result = $db->loadObject();
        $alias = $result->alias;
        $filteredAlias = JFilterOutput::stringURLSafe($alias);
        return $filteredAlias;
    }
    
    /**
     * Returns the category slug
     * @param int $catid Category ID
     * @param string $alias Category Alias
     * @return string category slug
     */
    public static function slug($catid, $alias){
        $slug = $catid.':'.$alias;
        return $slug;
    }
    
    /**
     * Returns the category slug
     * @param int $catid Category ID
     * @return string category slug
     */
    public static function slugFromId($catid){
        return self::slug($catid, self::aliasFromID($catid));
    }
}
