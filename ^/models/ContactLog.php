<?php
/**
 * ContactLog - AR class for submissions to the Contact form
 * File : /^/models/ContactLog.php
 *
 * PHP version 5.3
 *
 * @category Graphite
 * @package  Core
 * @author   LoneFry <dev@lonefry.com>
 * @license  CC BY-NC-SA http://creativecommons.org/licenses/by-nc-sa/3.0/
 * @link     http://g.lonefry.com
 */

/**
 * ContactLog class - AR class for submissions to the Contact form
 *
 * @category Graphite
 * @package  Core
 * @author   LoneFry <dev@lonefry.com>
 * @license  CC BY-NC-SA http://creativecommons.org/licenses/by-nc-sa/3.0/
 * @link     http://g.lonefry.com
 * @see      /^/lib/Record.php
 */
class ContactLog extends Record {
    protected static $table = 'ContactLog';
    protected static $pkey  = 'id';
    protected static $query = '';
    protected static $vars = array(
        'id'          => array('type' => 'i' , 'min' => 1, 'guard' => true),
        'from'        => array('type' => 'em', 'max' => 255),
        'date'        => array('type' => 'ts', 'min' => 0),
        'subject'     => array('type' => 's' , 'max' => 255),
        'to'          => array('type' => 'em', 'max' => 255),
        'body'        => array('type' => 's' , 'max' => 65535),
        'IP'          => array('type' => 'ip'),
        'login_id'    => array('type' => 'i' , 'strict' => true, 'def' => 0, 'min' => 1),
        'flagDismiss' => array('type' => 'b' , 'def' => 0)
    );

    /**
     * prime() initialized static values, call below class definition
     *
     * @return void
     */
    public static function prime() {
        parent::prime();
        self::$vars['IP']['def'] = $_SERVER['REMOTE_ADDR'];
        self::$vars['date']['def'] = time();
    }
}
ContactLog::prime();
