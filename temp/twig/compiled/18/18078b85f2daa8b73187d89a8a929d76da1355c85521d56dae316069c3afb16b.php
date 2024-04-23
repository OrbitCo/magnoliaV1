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

/* profile_menu.twig */
class __TwigTemplate_0d03fd7194f48cb9d6ee648f3a304085e37eba990b5bdacc0f13c7487129a2bb extends \Twig\Template
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
        $params = array("wall_events"        ,        );
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
            ob_start(function () { return ''; });
            // line 6
            echo "                ";
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
            echo $output_buffer.$result;
            // line 7
            echo "            ";
            $context["wall_section_name"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 8
            echo "            <li class=\"btn btn-default ";
            if ((($context["action"] ?? null) == "wall")) {
                echo "active";
            }
            echo "\">
                <a data-pjax-no-scroll=\"1\" href=\"";
            // line 9
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("users"            ,"profile"            ,["section-code" => "wall", "section-name" => ($context["wall_section_name"] ?? null)]            ,            );
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
            // line 10
            echo ($context["wall_section_name"] ?? null);
            echo "
                </a>
            </li>
        ";
        }
        // line 14
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
        // line 15
        echo "        <li class=\"btn btn-default ";
        if ((($context["action"] ?? null) == "view")) {
            echo "active";
        }
        echo "\">
            <a data-pjax-no-scroll=\"1\" href=\"";
        // line 16
        $module =         null;
        $helper =         'seo';
        $name =         'seolink';
        $params = array("users"        ,"profile"        ,["section-code" => "view", "section-name" => ($context["profile_section_name"] ?? null)]        ,        );
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
            $module =             null;
            $helper =             'utils';
            $name =             'depends';
            $params = array("media"            ,            );
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
            // line 22
            echo "            ";
            if ($this->getAttribute(($context["is_module_installed"] ?? null), "media", [])) {
                // line 23
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
                // line 24
                echo "                <li class=\"btn btn-default ";
                if ((($context["action"] ?? null) == "gallery")) {
                    echo "active";
                }
                echo "\" >
                    <a data-pjax-no-scroll=\"1\" href=\"";
                // line 25
                $module =                 null;
                $helper =                 'seo';
                $name =                 'seolink';
                $params = array("users"                ,"profile"                ,["section-code" => "gallery", "section-name" => ($context["gallery_section_name"] ?? null)]                ,                );
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
        return "profile_menu.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  270 => 31,  267 => 30,  260 => 26,  237 => 25,  230 => 24,  208 => 23,  205 => 22,  183 => 21,  181 => 20,  175 => 17,  152 => 16,  145 => 15,  123 => 14,  116 => 10,  93 => 9,  86 => 8,  83 => 7,  61 => 6,  58 => 5,  55 => 4,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "profile_menu.twig", "/home/mliadov/public_html/application/modules/users/views/flatty/profile_menu.twig");
    }
}
