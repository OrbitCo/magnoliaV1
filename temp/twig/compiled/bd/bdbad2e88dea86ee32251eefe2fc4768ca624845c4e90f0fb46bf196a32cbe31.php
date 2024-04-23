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

/* helper_favorites_link.twig */
class __TwigTemplate_84a0883a037087fe7d3b642455f43a76673a7401b9738cbdbb5fb48a30f4aa5d extends \Twig\Template
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
    <span id=\"fav_";
        // line 2
        echo ($context["id_dest_user"] ?? null);
        echo "\">
        <a class=\"add_to_fav ";
        // line 3
        if ((($context["action"] ?? null) == "remove")) {
            echo "hide";
        }
        echo " link-r-margin\"
            data-user_id=\"";
        // line 4
        echo ($context["id_dest_user"] ?? null);
        echo "\" href=\"";
        $module =         null;
        $helper =         'seo';
        $name =         'seolink';
        $params = array("favorites"        ,"add"        ,($context["id_dest_user"] ?? null)        ,        );
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
            data-pjax=\"0\" onclick=\"event.preventDefault();\" title=\"";
        // line 5
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("action_add"        ,"favorites"        ,        );
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
        // line 6
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("action_add"        ,"favorites"        ,        );
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
        <a class=\"remove_from_fav ";
        // line 8
        if ((($context["action"] ?? null) == "add")) {
            echo "hide";
        }
        echo " link-r-margin\"
            data-user_id=\"";
        // line 9
        echo ($context["id_dest_user"] ?? null);
        echo "\" href=\"";
        $module =         null;
        $helper =         'seo';
        $name =         'seolink';
        $params = array("favorites"        ,"remove"        ,($context["id_dest_user"] ?? null)        ,        );
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
            data-pjax=\"0\" onclick=\"event.preventDefault();\" title=\"";
        // line 10
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("action_remove"        ,"favorites"        ,        );
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
        // line 11
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("action_remove"        ,"favorites"        ,        );
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
        // line 12
        echo "        </a>
    </span>
</span>
<script>
\t\$(function() {
\t\tloadScripts(
            [\"";
        // line 18
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("favorites"        ,"favorites.js"        ,"path"        ,        );
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
            function() {
                favoritesObj = new favorites({
                    siteUrl: site_url,

                });
            },
            'favoritesObj'
        );
\t});
</script>
";
    }

    public function getTemplateName()
    {
        return "helper_favorites_link.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  198 => 18,  190 => 12,  169 => 11,  146 => 10,  121 => 9,  115 => 8,  112 => 7,  91 => 6,  68 => 5,  43 => 4,  37 => 3,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_favorites_link.twig", "/home/mliadov/public_html/application/modules/favorites/views/flatty/helper_favorites_link.twig");
    }
}
