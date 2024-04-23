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

/* helper_kisses_link.twig */
class __TwigTemplate_6440eb4495bf2dcf58f8b338088ce0edac2b4d272f1cdc3b6d38e4f8afd19515 extends \Twig\Template
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
        echo "<span class=\"user-menu-item\">
    <a id=\"btn-kisses-";
        // line 2
        echo ($context["kisses_button_rand"] ?? null);
        echo "\" href=\"javascript:void(0);\"
       class=\"btn-kisses";
        // line 3
        if (($context["kisses_back"] ?? null)) {
            echo "-back";
        }
        echo " link-r-margin\"
       title=\"";
        // line 4
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("kiss"        ,"kisses"        ,""        ,"button"        ,        );
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
        echo "\">
        ";
        // line 5
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("kiss"        ,"kisses"        ,""        ,"button"        ,        );
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
        // line 6
        echo "    </a>
</span>
<script>
    \$(function () {
        loadScripts(
                \"";
        // line 11
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("kisses"        ,"kisses.js"        ,"path"        ,        );
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
                    kisses = new Kisses({
                        siteUrl: site_url,
                        use_form: true,
                        btnForm: 'btn-kisses-";
        // line 16
        echo ($context["kisses_button_rand"] ?? null);
        echo "',
                        urlGetForm: 'kisses/ajax_get_kisses/";
        // line 17
        echo ($context["user_id"] ?? null);
        echo "',
                        urlSendForm: 'kisses/ajax_set_kisses/";
        // line 18
        echo ($context["user_id"] ?? null);
        echo "',
                        langs: {
                            kiss_empty: '";
        // line 20
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("no_select_kisses"        ,"kisses"        ,        );
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
        echo "'
                        }
                    });
                },
                ['kisses'],
                {async: false}
        );

    });
</script>
";
    }

    public function getTemplateName()
    {
        return "helper_kisses_link.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  134 => 20,  129 => 18,  125 => 17,  121 => 16,  94 => 11,  87 => 6,  66 => 5,  43 => 4,  37 => 3,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_kisses_link.twig", "/home/mliadov/public_html/application/modules/kisses/views/flatty/helper_kisses_link.twig");
    }
}
