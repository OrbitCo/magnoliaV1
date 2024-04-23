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

/* @app/header_navigation.twig */
class __TwigTemplate_911469819b242f21bd441c87601b1cfe07aebb6365667751393a18e5efd4ad7e extends \Twig\Template
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
        echo "<nav class=\"navbar navbar-flatty\">
    <div class=\"container-fluid\">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class=\"navbar-header\">
            ";
        // line 5
        if ($this->getAttribute(($context["mini_logo_settings"] ?? null), "text_logo_mini", [])) {
            // line 6
            echo "                <a class=\"navbar-brand logo\" href=\"";
            echo ($context["site_url"] ?? null);
            echo "\">
                    <span>";
            // line 7
            echo $this->getAttribute(($context["mini_logo_settings"] ?? null), "text_logo_mini", []);
            echo "</span>
                </a>
            ";
        } else {
            // line 10
            echo "                <a class=\"navbar-brand logo\" href=\"";
            echo ($context["site_url"] ?? null);
            echo "\">
                <img src=\"";
            // line 11
            echo ($context["site_root"] ?? null);
            echo $this->getAttribute(($context["mini_logo_settings"] ?? null), "path", []);
            echo "?";
            echo twig_random($this->env);
            echo "\" border=\"0\"
                alt=\"";
            // line 12
            $module =             null;
            $helper =             'seo';
            $name =             'seo_tags_default';
            $params = array("header_text"            ,            );
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
                width=\"";
            // line 13
            echo $this->getAttribute(($context["mini_logo_settings"] ?? null), "width", []);
            echo "\"
                height=\"";
            // line 14
            echo $this->getAttribute(($context["mini_logo_settings"] ?? null), "height", []);
            echo "\" id=\"logo\">
                </a>
            ";
        }
        // line 17
        echo "            <div class=\"navbar-ava-xs\">";
        $module =         null;
        $helper =         'users';
        $name =         'auth_links';
        $params = array(["is_mobile" => 1]        ,        );
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
        echo "</div>
            <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\"
                aria-expanded=\"false\">
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class=\"collapse navbar-collapse header-navigation\" id=\"bs-example-navbar-collapse-1\">
            <ul class=\"nav navbar-nav hidden-xs\">
                ";
        // line 27
        echo "                <li>";
        $module =         null;
        $helper =         'users';
        $name =         'top_menu';
        $params = array(["type" => "links"]        ,        );
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
        echo "</li>
            </ul>
            <ul class=\"nav navbar-nav navbar-right hidden-xs\">
                ";
        // line 30
        if ((($context["auth_type"] ?? null) == "user")) {
            // line 31
            echo "                    <li>
                        <div class=\"menu-top-right-block\">
                            ";
            // line 34
            echo "                        </div>
                    </li>
                ";
        }
        // line 37
        echo "                <li>";
        $module =         null;
        $helper =         'users';
        $name =         'top_menu';
        $params = array(["type" => "icons"]        ,        );
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
        echo "</li>
                <li>
                    ";
        // line 39
        $module =         null;
        $helper =         'users';
        $name =         'auth_links';
        $params = array(        );
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
        // line 40
        echo "                </li>
            </ul>
            <ul class=\"nav navbar-nav visible-xs-block\">
                <li>";
        // line 43
        $module =         null;
        $helper =         'users';
        $name =         'top_menu';
        $params = array(["type" => "xs"]        ,        );
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
        echo "</li>
                ";
        // line 44
        if ((($context["auth_type"] ?? null) == "user")) {
            // line 45
            echo "                    <li>
                        <div class=\"menu-top-right-block\">
                            ";
            // line 47
            $module =             null;
            $helper =             'start';
            $name =             'guide';
            $params = array(            );
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
            // line 48
            echo "                        </div>
                    </li>
                    <hr>
                        <li>";
            // line 51
            $module =             null;
            $helper =             'users';
            $name =             'top_menu';
            $params = array(["type" => "payments_xs"]            ,            );
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
            echo "</li>
                    <hr>
                ";
        }
        // line 54
        echo "                <li>
                    ";
        // line 55
        $module =         null;
        $helper =         'mobile';
        $name =         'mobile_app_links';
        $params = array(["show_xs_menu_title" => true]        ,        );
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
        // line 56
        echo "                </li>
                <li>
                    ";
        // line 58
        $module =         null;
        $helper =         'languages';
        $name =         'langSelect';
        $params = array(["template" => "helper_lang_select_xs"]        ,        );
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
        // line 59
        echo "                </li>
            </ul>
            <div style=\"height: 50px;\">&nbsp;</div>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
";
    }

    public function getTemplateName()
    {
        return "@app/header_navigation.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  343 => 59,  322 => 58,  318 => 56,  297 => 55,  294 => 54,  269 => 51,  264 => 48,  243 => 47,  239 => 45,  237 => 44,  214 => 43,  209 => 40,  188 => 39,  163 => 37,  158 => 34,  154 => 31,  152 => 30,  126 => 27,  94 => 17,  88 => 14,  84 => 13,  61 => 12,  54 => 11,  49 => 10,  43 => 7,  38 => 6,  36 => 5,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@app/header_navigation.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\views\\flatty\\header_navigation.twig");
    }
}
