{include file="header.tpl" load_type='ui'}

<form enctype="multipart/form-data" method="post" action="" name="save_form">
	<div class="edit-form n150">
		<div class="row header">{if $landing.id}{l i='admin_header_landing_edit' gid='landings'}{else}{l i='admin_header_landing_add' gid='landings'}{/if}</div>
        <div class="row">
			<div class="h">{l i='field_is_active' gid='landings'}: </div>
			<div class="v">
				<input type="checkbox" id="landing_is_active" name="landing_is_active" value="1" {if $landing.is_active}checked{/if}>
			</div>
		</div>	
		<div class="row">
			<div class="h">{l i='field_gid' gid='landings'}:* </div>
			<div class="v">
			{if $landing.gid}
				<div>{$landing.gid|escape}</div>
			{else}
				<input type="text" id="landing_gid" name="landing_gid" value="{$landing.gid|escape}">
			{/if}
			</div>
		</div>		
		<div class="row">
			<div class="h">{l i='field_name' gid='landings'}: </div>
			<div class="v">
				<input type="text" id="landing_name" name="landing_name" value="{$landing.name|escape}">
			</div>
		</div>
		<div class="row">
			<div class="h">{l i='field_link' gid='landings'}:* </div>
			<div class="v">
				<input type="text" id="landing_link" name="landing_link" value="{$landing.link|escape}">
			</div>
		</div>
		<div class="row">
			<div class="h">{l i='field_upload' gid='landings'}: </div>
			<div class="v">
				<input type="file" name="landing_file" id="landing_file" class="file">
			</div>
		</div>		
		{if $landing.upload_file}
		<div class="row">
			<div class="h">{l i='field_landing_upload_delete' gid='landings'}: </div>
			<div class="v">
				<input type="checkbox" name="landing_upload_delete" class="upload-preview" id="landing_upload_delete" value="1">
				{if $landing.is_active}
					<a href="{$site_url}{$landing.link}" class="upload-preview" target="_blank">{l i='upload_preview' gid='landings'}</a>
				{/if}
			</div>
		</div>
		{/if}
        <div class="row">
			<div class="v">
				{$landings_manager_text}
			</div>
		</div>
	</div>

	<div class="btn"><div class="l"><input type="submit" name="btn_save" value="{l i='btn_save' gid='start' type='button'}"></div></div>
	<a class="cancel" href="{$site_url}admin/landings/index/{$landings_settings.order}/{$landings_settings.order_direction}/{$landings_settings.page}">{l i='btn_cancel' gid='start'}</a>
</form>

{literal}
	<script type="text/javascript">
		$(function(){
            $('.edit-form .row:odd').addClass('zebra');
            loadScripts(
                "{/literal}{js file='landings.js' module='landings' return='path'}{literal}",
                function(){
                    landings = new Landings();
                },
                ['landings'],
                {async: false}
            );
		});
	</script>
{/literal}

{include file="footer.tpl"}

