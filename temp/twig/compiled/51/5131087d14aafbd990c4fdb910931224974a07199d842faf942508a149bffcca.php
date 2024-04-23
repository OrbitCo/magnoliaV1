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

/* dashboard.twig */
class __TwigTemplate_8e6ee3b4365419b9c80ba1e3a3932e1aba779ccd32a88feecf2fc9f2461ad17d extends \Twig\Template
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
        if ($this->getAttribute(($context["data"] ?? null), "html", [])) {
            // line 2
            echo "    ";
            echo $this->getAttribute(($context["data"] ?? null), "html", []);
            echo "
";
        } else {
            // line 4
            echo "    ";
            if (($this->getAttribute($this->getAttribute(($context["data"] ?? null), "user", []), "fname", []) || $this->getAttribute($this->getAttribute(($context["data"] ?? null), "user", []), "sname", []))) {
                // line 5
                echo "        <label>";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("field_name"                ,"users"                ,                );
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
                echo ":</label>
        ";
                // line 6
                if ($this->getAttribute($this->getAttribute(($context["data"] ?? null), "user", []), "is_deleted", [])) {
                    // line 7
                    echo "            ";
                    echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "user", []), "output_name", []);
                    echo "
        ";
                } else {
                    // line 9
                    echo "            <a href=\"";
                    echo ($context["site_url"] ?? null);
                    echo "admin/users/edit/personal/";
                    echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "user", []), "id", []);
                    echo "\" target=\"_blank\" >";
                    echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "user", []), "output_name", []);
                    echo "</a>
        ";
                }
                // line 10
                echo "<br>
    ";
            }
            // line 12
            echo "    ";
            if ($this->getAttribute($this->getAttribute(($context["data"] ?? null), "user", []), "nickname", [])) {
                // line 13
                echo "        <label>";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("field_nickname"                ,"users"                ,                );
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
                echo ":</label>
        <a href=\"";
                // line 14
                echo ($context["site_url"] ?? null);
                echo "admin/users/edit/personal/";
                echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "user", []), "id", []);
                echo "\" target=\"_blank\">
            ";
                // line 15
                echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "user", []), "nickname", []);
                echo "
        </a>
        <br/>
    ";
            }
            // line 19
            echo "    ";
            if ($this->getAttribute(($context["data"] ?? null), "comment", [])) {
                // line 20
                echo "        <label>";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("field_g_comment"                ,"users"                ,                );
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
                echo ":</label> ";
                echo $this->getAttribute(($context["data"] ?? null), "comment", []);
                echo "<br />
    ";
            }
        }
        // line 23
        if (($this->getAttribute(($context["data"] ?? null), "dashboard_status", []) != "added")) {
            // line 24
            echo "    <label>";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("text_status"            ,"start"            ,            );
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
            echo ":</label> ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array(((("status_" . $this->getAttribute(($context["data"] ?? null), "type_name", [])) . "_") . $this->getAttribute(($context["data"] ?? null), "dashboard_status", []))            ,$this->getAttribute($this->getAttribute(($context["data"] ?? null), "type", []), "module", [])            ,            );
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
        }
        // line 26
        echo "<div class=\"form-group\">
    ";
        // line 27
        if (($this->getAttribute(($context["data"] ?? null), "dashboard_status", []) == "added")) {
            // line 28
            echo "        <a data-type=\"";
            echo $this->getAttribute(($context["data"] ?? null), "type_name", []);
            echo "\" class=\"btn btn-success-ghost js-dashboard-action\" href=\"";
            echo ($context["site_url"] ?? null);
            echo "admin/moderation/approve/";
            echo $this->getAttribute(($context["data"] ?? null), "id", []);
            echo "\">
            <i class=\"fa fa-check\" aria-hidden=\"true\"></i>  ";
            // line 29
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("approve_object"            ,"moderation"            ,            );
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
            // line 30
            echo "        </a>
        <a data-type=\"";
            // line 31
            echo $this->getAttribute(($context["data"] ?? null), "type_name", []);
            echo "\" data-moderation=\"decline\"  data-title=\"";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("decline_object"            ,"moderation"            ,            );
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
            echo "\" data-href=\"";
            echo ($context["site_url"] ?? null);
            echo "admin/moderation/decline/";
            echo $this->getAttribute(($context["data"] ?? null), "id", []);
            echo "/\" class=\"btn btn-danger-ghost js-dashboard-action\" href=\"";
            echo ($context["site_url"] ?? null);
            echo "admin/moderation/decline/";
            echo $this->getAttribute(($context["data"] ?? null), "id", []);
            echo "/\">
            <i class=\"fa fa-ban\" aria-hidden=\"true\"></i>  ";
            // line 32
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("decline_object"            ,"moderation"            ,            );
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
            // line 33
            echo "        </a>
    ";
        }
        // line 35
        echo "    ";
        if (($this->getAttribute(($context["data"] ?? null), "dashboard_status", []) != "deleted")) {
            // line 36
            echo "        <div class=\"mtb10\">
            <a href=\"";
            // line 37
            echo ($context["site_url"] ?? null);
            echo $this->getAttribute(($context["data"] ?? null), "dashboard_action_link", []);
            echo "\" target=\"_blank\" >
                ";
            // line 38
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_section_action"            ,$this->getAttribute($this->getAttribute(($context["data"] ?? null), "type", []), "module", [])            ,            );
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
            // line 39
            echo "            </a>
        </div>
        <div class=\"clearfix\"></div>
    ";
        }
        // line 43
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "dashboard.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  338 => 43,  332 => 39,  311 => 38,  306 => 37,  303 => 36,  300 => 35,  296 => 33,  275 => 32,  242 => 31,  239 => 30,  218 => 29,  209 => 28,  207 => 27,  204 => 26,  160 => 24,  158 => 23,  130 => 20,  127 => 19,  120 => 15,  114 => 14,  90 => 13,  87 => 12,  83 => 10,  73 => 9,  67 => 7,  65 => 6,  41 => 5,  38 => 4,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "dashboard.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\moderation\\views\\gentelella\\dashboard.twig");
    }
}
