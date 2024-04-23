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

/* profile_top_magazine.twig */
class __TwigTemplate_961df9dd9eb8296d728a48284e583e0618f93b8a15bbac3d6eae14020bfe6a5f extends \Twig\Template
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
        $module =         null;
        $helper =         'utils';
        $name =         'depends';
        $params = array("access_permissions"        ,"mailbox"        ,        );
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
        $context['is_module_installed'] = $result;
        // line 2
        echo "<div class=\"magazine-profile__prename user-all-magazine-description\">
    ";
        // line 3
        echo $this->getAttribute(($context["data"] ?? null), "age", []);
        echo " ";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("text_age"        ,"users"        ,        );
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
        echo "<span class=\"dot-splitter\">•</span>
    <span ";
        // line 4
        if (($context["is_owner"] ?? null)) {
            echo "class=\"pointer\" data-change=\"location\"";
        }
        echo ">
        <i class=\"fas fa-map-marker-alt\"></i>&nbsp;
        ";
        // line 6
        if ((($this->getAttribute(($context["data"] ?? null), "city", []) || $this->getAttribute(($context["data"] ?? null), "region", [])) || $this->getAttribute(($context["data"] ?? null), "country", []))) {
            // line 7
            echo "            ";
            echo $this->getAttribute(($context["data"] ?? null), "location", []);
            echo "
        ";
        } else {
            // line 9
            echo "            ";
            if (($context["is_user_owner"] ?? null)) {
                // line 10
                echo "                ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("link_select_region"                ,"countries"                ,                );
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
                // line 11
                echo "            ";
            } else {
                // line 12
                echo "                ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("location_not_specified"                ,"countries"                ,                );
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
                // line 13
                echo "            ";
            }
            // line 14
            echo "        ";
        }
        // line 15
        echo "    </span>
    <script>
        \$(function () {
            loadScripts(
                [\"";
        // line 19
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
        echo "\"],
                function () {
                    change_location = new usersSettings({
                        siteUrl: site_url,
                        langs: {
                            link_select_region: \"";
        // line 24
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_select_region"        ,"countries"        ,        );
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
                        }
                    });
                },
                ['change_location'],
                {async: false}
            );
        });
    </script>
</div>

<h1 class=\"magazine-profile__name\">";
        // line 35
        echo $this->getAttribute(($context["data"] ?? null), "output_name", []);
        echo "</h1>
";
    }

    public function getTemplateName()
    {
        return "profile_top_magazine.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  216 => 35,  183 => 24,  156 => 19,  150 => 15,  147 => 14,  144 => 13,  122 => 12,  119 => 11,  97 => 10,  94 => 9,  88 => 7,  86 => 6,  79 => 4,  54 => 3,  51 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "profile_top_magazine.twig", "/home/mliadov/public_html/application/modules/users/views/flatty/profile_top_magazine.twig");
    }
}
