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

/* helper_send_gift_magazine.twig */
class __TwigTemplate_03b9de581fde9961b2fd2425fed328d6ece360399e5343c7896c37c58b362436 extends \Twig\Template
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
        echo "<li class=\"pg-dl-icons ";
        if (($this->getAttribute(($context["virtual_params"] ?? null), "is_main_menu_actions", []) == 1)) {
        } else {
            echo "menu-actions";
        }
        echo " fleft\">
    <span class=\"user-menu-item\" id=\"link-virtual_gift-";
        // line 2
        echo ($context["virtual_gifts_button_rand"] ?? null);
        echo "\">
        <a id=\"btn-virtual_gift-";
        // line 3
        echo ($context["virtual_gifts_button_rand"] ?? null);
        echo "\" class=\"link-r-margin\"
           title=\"";
        // line 4
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("user_send_gift_alt"        ,"virtual_gifts"        ,""        ,"button"        ,        );
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
        echo "\"
           href=\"javascript:void(0);\"><i class=\"fa fa-gift\"></i>
            ";
        // line 6
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("user_send_gift_alt"        ,"virtual_gifts"        ,""        ,"button"        ,        );
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
        // line 7
        echo "        </a>
    </span>
</li>            
<script>
    \$(function () {
        loadScripts(
                \"";
        // line 13
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("virtual_gifts"        ,"send_gift.js"        ,"path"        ,        );
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
                function () {
                    virtual_gifts = new SendGift({
                        siteUrl: site_url,
                        use_form: true,
                        btnForm: 'link-virtual_gift-";
        // line 18
        echo ($context["virtual_gifts_button_rand"] ?? null);
        echo "',
                        urlGetForm: 'virtual_gifts/ajax_get_gifts_form/";
        // line 19
        echo ($context["user_id"] ?? null);
        echo "',
                        urlSendForm: 'virtual_gifts/ajax_set_gifts/";
        // line 20
        echo ($context["user_id"] ?? null);
        echo "',
                        dataType: 'html'
                    });
                },
                ['virtual_gifts'],
                {async: false}
        );

    });
</script>
";
    }

    public function getTemplateName()
    {
        return "helper_send_gift_magazine.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  134 => 20,  130 => 19,  126 => 18,  99 => 13,  91 => 7,  70 => 6,  46 => 4,  42 => 3,  38 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_send_gift_magazine.twig", "/home/mliadov/public_html/application/modules/virtual_gifts/views/flatty/helper_send_gift_magazine.twig");
    }
}
