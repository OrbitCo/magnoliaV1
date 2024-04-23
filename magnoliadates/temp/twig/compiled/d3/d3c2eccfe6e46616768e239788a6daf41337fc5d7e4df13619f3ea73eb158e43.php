<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* helper_available_activation.twig */
class __TwigTemplate_2d298952420f76fb19eb31cda9b29f7c6f9f21e26468c5e9be806cd2bd071d09 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<script type=\"text/javascript\">
    \$(function () {
        loadScripts(
                [\"";
        // line 4
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("users"        ,"users-settings.js"        ,"path"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo "\",
                    \"";
        // line 5
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("users"        ,"../views/flatty/js/users-avatar.js"        ,"path"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo "\"],
                function () {
                    user_avatar = new UsersAvatar({
                        site_url: site_url,
                        id_user: id_user,
                        haveAvatar: false,
                        callback: function () {
                            (new usersSettings({siteUrl: site_url})).rebuild('user_logo');
                        }
                    });
                    av_activation = new usersSettings({
                        siteUrl: site_url,
                        avatarObj: user_avatar,
                        errorObj: new Errors({
                            expires: 3600,
                            path: '";
        // line 20
        echo ($context["site_root"] ?? null);
        echo "',
                            domain: '";
        // line 21
        echo ($context["site_url"] ?? null);
        echo "'
                        })
                    }).availableActivation();
                },
                ['av_activation' ,'user_avatar'],
                {async: false}
        );
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "helper_available_activation.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  99 => 21,  95 => 20,  58 => 5,  35 => 4,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_available_activation.twig", "/home/mliadov/public_html/application/modules/users/views/flatty/helper_available_activation.twig");
    }
}
