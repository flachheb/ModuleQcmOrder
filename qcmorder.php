<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

class QcmOrder extends Module
{

    public function __construct()
    {
        $this->name = 'qcmorder';
        $this->version = '1.0.0';
        $this->author = 'Faissal Lachheb';
        $this->need_instance = 0;

        $this->bootstrap = true;
        parent::__construct();

        $this->displayName = $this->trans('QCM Order', array(), 'Modules.Qcmorder.Admin');
        $this->description = $this->trans('Display a QCM in a new step commande', array(), 'Modules.Qcmorder.Admin');

        $this->ps_versions_compliancy = array('min' => '1.7.1.0', 'max' => _PS_VERSION_);

    }

    /**
     * @return bool
     */
    public function install()
    {
        return parent::install() && $this->installDB();
    }

    /**
     * @return bool
     */
    public function uninstall()
    {
        return parent::uninstall() && $this->uninstallDB();
    }

    /**
     * @return bool
     */
    public function installDB()
    {
        $return = Db::getInstance()->execute('
                CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'customer_health` (
                `id_customer_health` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                `id_customer` INT UNSIGNED NOT NULL,
                `height` INT(10) UNSIGNED NOT NULL,
                `weight` INT(10) UNSIGNED NOT NULL ,
                `age` INT(10) UNSIGNED NOT NULL ,
                PRIMARY KEY (`id_customer_health`)
            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8 ;'
        );
        return $return;
    }

    /**
     *
     * @return bool
     */
    public function uninstallDB()
    {

        return Db::getInstance()->execute('DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'customer_health`');
    }

    public function getContent()
    {
        $qcmList = $this->getQcmList();

        $this->context->smarty->assign(
            [
                'link' => $this->context->link,
                'qcmList' => $qcmList,
            ]
        );

        return $this->display(__FILE__, 'list.tpl');
    }

    public function getQcmList()
    {
        $qcmList = Db::getInstance((bool) _PS_USE_SQL_SLAVE_)->executeS('
            SELECT ch.*, c.`firstname`, c.`lastname`
            FROM ' . _DB_PREFIX_ . 'customer_health ch
            LEFT JOIN ' . _DB_PREFIX_ . 'customer c ON (ch.id_customer = c.id_customer)
            '
        );

        return $qcmList;
    }
}
