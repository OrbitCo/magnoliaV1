{include file="header.tpl"}
<div class="actions">&nbsp;</div>

<div class="menu-level3">
	<ul>
		<li><a href="{$site_url}admin/statistics/index/all">{l i='filter_all_systems' gid='statistics'} ({$filter_data.all})</a></li>
		<li><a href="{$site_url}admin/statistics/index/used">{l i='filter_used_systems' gid='statistics'} ({$filter_data.used})</a></li>
		<li class="active"><a href="{$site_url}admin/statistics/install">{l i='filter_install_systems' gid='statistics'}</a></li>
	</ul>
	&nbsp;
</div>
<table cellspacing="0" cellpadding="0" class="data" width="100%">
<tr>
	<th class="first">{l i='field_system_name' gid='statistics'}</th>
	<th class="w400 ">{l i='field_statistics_events' gid='statistics'}</th>
	<th class="w100 ">&nbsp;</th>
</tr>
{foreach from=$systems item=item}
<tr>
	<td class="first center">{$item.name}</td>
	<td class="left">
        {foreach from=$item.events item=event}
            <span style="font-weight: bold;">{$event.field_name}</span> - {$event.field_description}<br>
        {/foreach}        
    </td>
	<td class="center">
		<a href="{$site_url}admin/statistics/install_system/{$item.gid}" title="{l i='link_install_system' gid='statistics'}">{l i='link_install_system' gid='statistics'}</a>
	</td>
</tr>
{foreachelse}
<tr><td colspan="3" class="center">{l i='no_modules' gid='statistics'}</td></tr>
{/foreach}
</table>
{include file="footer.tpl"}
