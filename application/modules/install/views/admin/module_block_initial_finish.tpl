{if $errors}
    <h3>Config rewriting</h3>
    <div>
    {foreach item=item from=$errors}
    <font class="req">{$item}</font><br>
    {/foreach}
    </div>
    <br><br>
    <div class="btn"><div class="l"><input type="button" onclick="javascript: product_install.request('overall_product');" name="refresh_install" value="Refresh"></div></div>
    <div class="clr"></div>
{else}
    <h3>The site is successfully installed! </h3>
    <div>
    {foreach item=item from=$messages}
    <b>{$item}</b><br><br>
    {/foreach}
    </div>
    <br><br>
    <div class="btn"><div class="l"><input type="button" onclick="javascript: location.href='{$site_url}';" name="finish_install" value="Finish"></div></div>
    <div class="clr"></div>
    <script type="text/javascript" >
    {literal}
    $(function(){
        window.open('https://www.pilotgroup.net/connect.php?product={/literal}{$product_name}{literal}');
    });
    {/literal}
    </script>
{/if}
<script>
{literal}$(function(){{/literal}
    product_install.update_overall_progress({$current_overall_percent});
{literal}});{/literal}
</script>
