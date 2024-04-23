{include file="header.tpl"}
{helper func_name='get_admin_level1_menu' helper_name='menu' func_param='admin_landings_menu'}

<div class="actions">
	<ul>
		<li><div class="l"><a href="{$site_url}admin/landings/edit">{l i='link_add_landing' gid='landings'}</a></div></li>
        <li><div class="l"><a id="landings_link_delete" href="javascript:void(0)">{l i='link_del_landings' gid='landings'}</a></div></li>
	</ul>
	&nbsp;
</div>

<table cellspacing="0" cellpadding="0" class="data" width="100%">
	<tr>
		<th class="first w20 center">
			<input type="checkbox" id="landing_grouping_all">
		</th>
        <th>
			<a href="{$sort_links.name'}"{if $order eq 'name'} class="{$order_direction|lower}"{/if}>{l i='field_name' gid='landings'}</a>
		</th>
		<th>
			<a href="{$sort_links.link'}"{if $order eq 'link'} class="{$order_direction|lower}"{/if}>{l i='field_link' gid='landings'}</a>
		</th>
		<th class="w150">
			<a href="{$sort_links.date_created'}"{if $order eq 'date_created'} class="{$order_direction|lower}"{/if}>{l i='field_date_created' gid='landings'}</a>
		</th>
		<th class="w150">&nbsp;</th>
	</tr>
	{foreach item=item from=$landings}
		{counter print=false assign=counter}
		<tr{if $counter is div by 2} class="zebra"{/if}>
			<td class="first"><input type="checkbox" class="grouping" value="{$item.id}"></td>
			<td class="center">{$item.name}</td>
			<td class="center">{$item.link}</td>
			<td class="center">{$item.date_created|date_format:$date_format}</td>
			<td class="icons">
                {if $item.is_active}
                    <a href="{$site_url}admin/landings/activate/{$item.id}/0"><img src="{$site_root}{$img_folder}icon-full.png" width="16" height="16" border="0" alt="{l i='link_deactivate_landing' gid='landings'}" title="{l i='link_deactivate_landing' gid='landings'}"></a>
				{else}
					<a href="{$site_url}admin/landings/activate/{$item.id}/1"><img src="{$site_root}{$img_folder}icon-empty.png" width="16" height="16" border="0" alt="{l i='link_activate_landing' gid='landings'}" title="{l i='link_activate_landing' gid='landings'}"></a>
				{/if}
				<a href="{$site_url}admin/landings/edit/{$item.id}"><img src="{$site_root}{$img_folder}icon-edit.png" width="16" height="16" border="0" alt="{l i='link_edit_landing' gid='landings'}" title="{l i='link_edit_landing' gid='landings'}"></a><a href="{$site_url}admin/landings/delete/{$item.id}" onclick="javascript: if(!confirm('{l i='note_delete_langing' gid='landings' type='js'}')) return false;"><img src="{$site_root}{$img_folder}icon-delete.png" width="16" height="16" border="0" alt="{l i='link_delete_landing' gid='landings'}" title="{l i='link_delete_landing' gid='landings'}"></a>
			</td>
		</tr>
	{foreachelse}
		<tr>
			<td colspan="8" class="center">{l i='no_landings' gid='landings'}</td>
		</tr>
	{/foreach}
</table>

{literal}
	<script type="text/javascript">
		$(function(){
			var lang_data = {btn_delete_confirm: "{/literal}{l i='note_delete_langing' gid='landings' type='js'}{literal}"};

            loadScripts(
                "{/literal}{js file='landings.js' module='landings' return='path'}{literal}",
                function(){
                    landings = new Landings({
                        siteUrl: site_url,
						lang_data: lang_data,
                    });
                },
                ['landings'],
                {async: false}
            );
		});
	</script>
{/literal}

{include file="pagination.tpl"}
{include file="footer.tpl"}
