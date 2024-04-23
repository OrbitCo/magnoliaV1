{include file="header.tpl"}

<form method="post" action="{$data.action}">
    <div class="filter-form">
        <div class="form">
            <div class="row">This is a checklist of system requirements for your server. Obligatory items are marked (*). You can skip the rest and continue with the installation.</div>
            <div class="row">
                <div class="h">System requirements:</div>
                <div class="v">
                    {foreach from=$requirements item=item}
                        {if $item}
                            {if $item.status|is_array}
                                {foreach from=$item.status item=subitem key=subkey}
                                    <div>
                                        <font class="{if $subitem}success{else}error{/if}">
                                        <i class="fa fa-{if $subitem}check{else}times{/if}"></i>&nbsp;{$item.msg[$subkey]}
                                        </font>
                                    </div>
                                {/foreach}
                            {else}
                                <div>
                                    <font class="{if $item.status}success{else}error{/if}">
                                    <i class="fa fa-{if $item.status}check{else}times{/if}"></i>&nbsp;{$item.msg}
                                    </font>
                                </div>
                            {/if}
                        {/if}
                    {/foreach}
                </div>
            </div>
            <div class="row">
                <div class="h">Permissions for config file:</div>
                <div class="v">
                    {if $data.install_writeable}
                        <font class="success">file <b>'{$data.install_file}'</b> <br>is writable</font>
                    {else}
                        <font class="error">Please change file permissions to 777 <br><b>'{$data.install_file}'</b></font>
                    {/if}<br>
                    {if $data.config_writeable}
                        <font class="success">file <b>'{$data.config_file}'</b> <br>is writable</font>
                    {else}
                        <font class="error">Please change file permissions to 777 <br><b>'{$data.config_file}'</b></font>
                    {/if}
                </div>
            </div>
            <br>
        </div>
        {if $data.ftp}
            <br>
            <h3>FTP access info</h3>
            <div class="form">
                <i>(necessary to update modules)</i><br>
                <div class="row">
                    <div class="h">FTP host: </div>
                    <div class="v"><input type="text" value="{$data.ftp_host}" name="ftp_host"></div>
                </div>
                <div class="row">
                    <div class="h">FTP user: </div>
                    <div class="v"><input type="text" value="{$data.ftp_user}" name="ftp_user"></div>
                </div>
                <div class="row">
                    <div class="h">FTP password: </div>
                    <div class="v"><input type="password" value="{$data.ftp_password}" name="ftp_password"></div>
                </div>
            </div>
        {/if}
    </div>
    <div class="btn"><div class="l"><input type="submit" name="save_install_login" value="Next"></div></div>
    <div class="btn"><div class="l"><input type="submit" name="skip_install_login" value="Skip"></div></div>
    <div class="btn gray fright"><div class="l"><a href="{$site_url}admin/install/install_admin">Refresh</a></div></div>
    <div class="clr"></div>
    {include file="footer.tpl"}
