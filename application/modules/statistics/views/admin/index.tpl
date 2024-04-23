{include file="header.tpl"}
<div class="actions">&nbsp;</div>
<div class="menu-level3">
	<ul>
		<li {if $filter eq 'all'}class="active"{/if}><a href="{$site_url}admin/statistics/index/all">{l i='filter_all_systems' gid='statistics'} ({$filter_data.all})</a></li>
		<li {if $filter eq 'used'}class="active"{/if}><a href="{$site_url}admin/statistics/index/used">{l i='filter_used_systems' gid='statistics'} ({$filter_data.used})</a></li>
		<li><a href="{$site_url}admin/statistics/install">{l i='filter_install_systems' gid='statistics'}</a></li>
	</ul>
	&nbsp;
</div>
<table cellspacing="0" cellpadding="0" class="data" width="100%">
	<tr>
		<th class="first w100">{l i='field_module' gid='statistics'}</th>
		<th class="w150">{l i='field_statistics_events' gid='statistics'}</th>
		<th class="w70">&nbsp;</th>
	</tr>
	{foreach item=item from=$systems}
	<tr>				
		<td class="center">{$item.module}</td>
		<td class="left">
            {foreach from=$item.events item=event}
                <div>
                    <span style="vertical-align: baseline;">
                        {if $event.status}
                        <a href="{$site_url}admin/statistics/activate_event/{$item.id}/{$event.gid}/0"><img src="{$site_root}{$img_folder}icon-full.png" width="16" height="16" border="0" alt="{l i='link_deactivate_event' gid='statistics'}" title="{l i='link_deactivate_event' gid='statistics'}"></a>
                        {else}
                        <a href="{$site_url}admin/statistics/activate_event/{$item.id}/{$event.gid}/1"><img src="{$site_root}{$img_folder}icon-empty.png" width="16" height="16" border="0" alt="{l i='link_activate_event' gid='statistics'}" title="{l i='link_activate_event' gid='statistics'}"></a>
                        {/if}
                    </span>
                    <span style="vertical-align: baseline;font-weight: bold;">{$event.field_name}</span><span style="vertical-align: baseline;"> - {$event.field_description}</span><br>
                </div>
            {/foreach}                 
        </td>
		<td class="icons">
			{if $item.status eq '1'}
				<a href="{$site_url}admin/statistics/activate/{$item.id}/0" title="{l i='title_activate' gid='statistics'}"><i class="fa fa-power-off"></i></a>
			{else}
				<a href="{$site_url}admin/statistics/activate/{$item.id}/1" title="{l i='title_deactivate' gid='statistics'}"><i class="fa fa-power-off inactive"></i></a>
			{/if}
			<a href="{$site_url}admin/statistics/reset/{$item.id}" onclick="javascript: if(!confirm('{l i='note_statistics_reset' gid='statistics' type='js'}')) return false;" title="{l i='title_clear' gid='statistics'}"><i class="fa fa-recycle"></i></a>
			<a href="{$site_url}admin/statistics/uninstall/{$item.id}" onclick="javascript: if(!confirm('{l i='note_statistics_uninstall' gid='statistics' type='js'}')) return false;" title="{l i='title_uninstall' gid='statistics'}"><i class="fa fa-trash-o"></i></a>
		</td>
	</tr>
	{foreachelse}
	<tr><td colspan="5" class="center">{l i='no_modules' gid='statistics'}</td></tr>
	{/foreach}
</table>

{include file="footer.tpl"}
