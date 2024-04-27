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

/* view_profile_menu.twig */
class __TwigTemplate_24c9500b2e35374e9e9f93766195c37310fce78798a8e694fcc83cfcbde3eeec extends \Twig\Template
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
        echo "<div class=\"profile-menu clearfix\">
    <ul class=\"btn-group mb10\">
        ";
        // line 3
        $module =         null;
        $helper =         'utils';
        $name =         'depends';
        $params = array("wall_events"        ,"media"        ,        );
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
        // line 4
        echo "        ";
        if ($this->getAttribute(($context["is_module_installed"] ?? null), "wall_events", [])) {
            // line 5
            echo "            ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("filter_section_wall"            ,"users"            ,            );
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
            $context['wall_section_name'] = $result;
            // line 6
            echo "            <li class=\"btn btn-default ";
            if ((($context["profile_section"] ?? null) == "wall")) {
                echo "active";
            }
            echo "\">
                ";
            // line 7
            $context["seodata1"] = twig_array_merge(($context["seodata"] ?? null), ["section-code" => "wall", "section-name" => ($context["wall_section_name"] ?? null)]);
            // line 8
            echo "                <a data-pjax-no-scroll=\"1\" href=\"";
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("users"            ,"view"            ,($context["seodata1"] ?? null)            ,            );
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
            // line 9
            echo ($context["wall_section_name"] ?? null);
            echo "
                </a>
            </li>
        ";
        }
        // line 13
        echo "        ";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_section_profile"        ,"users"        ,        );
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
        $context['profile_section_name'] = $result;
        // line 14
        echo "        <li class=\"btn btn-default  ";
        if ((($context["profile_section"] ?? null) == "profile")) {
            echo "active";
        }
        echo "\">
            ";
        // line 15
        $context["seodata2"] = twig_array_merge(($context["seodata"] ?? null), ["section-code" => "profile", "section-name" => ($context["profile_section_name"] ?? null)]);
        // line 16
        echo "            <a data-pjax-no-scroll=\"1\" href=\"";
        $module =         null;
        $helper =         'seo';
        $name =         'seolink';
        $params = array("users"        ,"view"        ,($context["seodata2"] ?? null)        ,        );
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
        // line 17
        echo ($context["profile_section_name"] ?? null);
        echo "
            </a>
        </li>
        ";
        // line 20
        if (( !($context["template"] ?? null) == "magazine")) {
            // line 21
            echo "            ";
            if ($this->getAttribute(($context["is_module_installed"] ?? null), "media", [])) {
                // line 22
                echo "                ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("filter_section_gallery"                ,"users"                ,                );
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
                $context['gallery_section_name'] = $result;
                // line 23
                echo "                <li class=\"btn btn-default ";
                if ((($context["profile_section"] ?? null) == "gallery")) {
                    echo "active";
                }
                echo "\" >
                    ";
                // line 24
                $context["seodata3"] = twig_array_merge(($context["seodata"] ?? null), ["section-code" => "gallery", "section-name" => ($context["gallery_section_name"] ?? null)]);
                // line 25
                echo "                    <a data-pjax-no-scroll=\"1\" href=\"";
                $module =                 null;
                $helper =                 'seo';
                $name =                 'seolink';
                $params = array("users"                ,"view"                ,($context["seodata3"] ?? null)                ,                );
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
                // line 26
                echo ($context["gallery_section_name"] ?? null);
                echo "
                    </a>
                </li>
            ";
            }
            // line 30
            echo "        ";
        }
        // line 31
        echo "    </ul>
</div>
";
    }

    public function getTemplateName()
    {
        return "view_profile_menu.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  251 => 31,  248 => 30,  241 => 26,  217 => 25,  215 => 24,  208 => 23,  186 => 22,  183 => 21,  181 => 20,  175 => 17,  151 => 16,  149 => 15,  142 => 14,  120 => 13,  113 => 9,  89 => 8,  87 => 7,  80 => 6,  58 => 5,  55 => 4,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "view_profile_menu.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\users\\views\\flatty\\view_profile_menu.twig");
    }
}
