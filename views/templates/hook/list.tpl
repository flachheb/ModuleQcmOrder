{*
 * 2007-2020 PrestaShop.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
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
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2020 PrestaShop SA
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
<div class="panel">
    <h3>
        <i class="icon-list-ul"></i> {l s='QCM list' d='Modules.Qcmorder.Admin'}
	</h3>

	<table id="qcmListContent" class="table">
		<thead>
			<tr class="nodrag nodrop">
				<th>
					<span class="title_box">ID</span>
				</th>
				<th>
					<span class="title_box">Customer</span>
				</th>
				<th>
					<span class="title_box">Weight</span>
				</th>
				<th>
					<span class="title_box">Height</span>
				</th>
				<th>
					<span class="title_box">Age</span>
				</th>
			</tr>
		</thead>

		<tbody>
			{foreach from=$qcmList item=qcm}
			<tr>
				<td>{$qcm.id_customer}</td>
				<td>{$qcm.firstname} {$qcm.lastname}</td>
				<td>{$qcm.weight}</td>
				<td>{$qcm.height}</td>
				<td>{$qcm.age}</td>
			</tr>
			{/foreach}
		</tbody>
	</table>
</div>