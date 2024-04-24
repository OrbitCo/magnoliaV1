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

/* helper_permissions.twig */
class __TwigTemplate_ab0d3d762e1833e69f3cbe3127c1e956eb4658d3a517c9500370a9eff216f2a2 extends \Twig\Template
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
        echo "<h2>";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_permissions"        ,"access_permissions"        ,        );
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
        echo "</h2>
<div id=\"permissions-list\" class=\"permissions-lists\">
    <table class=\"table table-striped responsive-utilities jambo_table bulk_action\">
        <thead>
            <tr class=\"headings\">
                <th class=\"column-title\">
                    <div>";
        // line 7
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_page_section"        ,"access_permissions"        ,        );
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
                </th>
                ";
        // line 9
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["groups"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
            // line 10
            echo "                    <th class=\"column-title\" data-group_actions=\"";
            echo $this->getAttribute($context["group"], "gid", []);
            echo "\">
                        <div data-toggle=\"tooltip\" data-placement=\"top\" title=\"";
            // line 11
            echo $this->getAttribute($context["group"], "current_name", []);
            echo "\">";
            echo $this->getAttribute($context["group"], "current_name", []);
            echo "</div>
                    </th>
                ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 14
            echo "                    <th class=\"column-title\" >
                        <div>";
            // line 15
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_users_guest"            ,"access_permissions"            ,            );
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
                    </th>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 18
        echo "            </tr>
        </thead>
        <tbody>
            ";
        // line 21
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["access_sections"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["section"]) {
            // line 22
            echo "                <tr class=\"cursor-pointer\"
                                    data-user_type=\"";
            // line 23
            echo ($context["user_type"] ?? null);
            echo "\"
                                    data-action=\"change_permissions\"
                                    data-module_gid=\"";
            // line 25
            echo $this->getAttribute($context["section"], "module_gid", []);
            echo "\"
                                    data-method=\"";
            // line 26
            echo $this->getAttribute($context["section"], "method", []);
            echo "\"
                                    data-access=\"";
            // line 27
            echo $this->getAttribute($context["section"], "access", []);
            echo "\">
                    <td>";
            // line 28
            echo $this->getAttribute($context["section"], "name", []);
            echo "</td>
                    ";
            // line 29
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["groups"] ?? null));
            $context['_iterated'] = false;
            foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
                // line 30
                echo "                        <td class=\"icons\" data-group_actions=\"";
                echo $this->getAttribute($context["group"], "gid", []);
                echo "\">
                                <div class=\"permissions-list\">
                                    <i class=\"";
                // line 32
                if (($this->getAttribute($this->getAttribute($this->getAttribute($context["section"], "status_access", []), $this->getAttribute($context["group"], "gid", []), [], "array"), "status", []) != "full")) {
                    echo "far ";
                } else {
                    echo " fas ";
                }
                echo "fa-circle\">
                                        ";
                // line 33
                if (($this->getAttribute($this->getAttribute($this->getAttribute($context["section"], "status_access", []), $this->getAttribute($context["group"], "gid", []), [], "array"), "status", []) == "incomplete")) {
                    echo "<span class=\"incomplete\"></span>";
                }
                // line 34
                echo "                                    </i>
                                </div>
                        </td>
                    ";
                $context['_iterated'] = true;
            }
            if (!$context['_iterated']) {
                // line 38
                echo "                        <td class=\"icons\">
                                <div class=\"permissions-list\">
                                    <i class=\"fa fa-circle";
                // line 40
                if (($this->getAttribute($this->getAttribute($this->getAttribute($context["section"], "status_access", []), "guest", [], "array"), "status", []) != "full")) {
                    echo "-o";
                }
                echo "\">
                                        ";
                // line 41
                if (($this->getAttribute($this->getAttribute($this->getAttribute($context["section"], "status_access", []), "guest", [], "array"), "status", []) == "incomplete")) {
                    echo "<span class=\"incomplete\"></span>";
                }
                // line 42
                echo "                                    </i>
                                </div>
                        </td>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['group'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 46
            echo "                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['section'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 48
        echo "            <tr>
                <td colspan=\"";
        // line 49
        if (($context["groups"] ?? null)) {
            echo (2 + twig_length_filter($this->env, ($context["groups"] ?? null)));
        } else {
            echo "2";
        }
        echo "\" class=\"text-center\">
                    <div class=\"permissions-list\">
                        <span class=\"ml20\">
                            <i class=\"fa fa-circle\"></i> ";
        // line 52
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_access_leve_full"        ,"access_permissions"        ,        );
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
        // line 53
        echo "                        </span>
                        <span class=\"ml20\">
                            <i class=\"far fa-circle\">
                                <span class=\"incomplete\"></span>
                            </i> ";
        // line 57
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_access_leve_incomplete"        ,"access_permissions"        ,        );
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
        // line 58
        echo "                        </span>
                        <span class=\"ml20\">
                            <i class=\"far fa-circle\"></i> ";
        // line 60
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_access_leve_null"        ,"access_permissions"        ,        );
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
        // line 61
        echo "                        </span>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>

";
    }

    public function getTemplateName()
    {
        return "helper_permissions.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  314 => 61,  293 => 60,  289 => 58,  268 => 57,  262 => 53,  241 => 52,  231 => 49,  228 => 48,  221 => 46,  212 => 42,  208 => 41,  202 => 40,  198 => 38,  190 => 34,  186 => 33,  178 => 32,  172 => 30,  167 => 29,  163 => 28,  159 => 27,  155 => 26,  151 => 25,  146 => 23,  143 => 22,  139 => 21,  134 => 18,  106 => 15,  103 => 14,  93 => 11,  88 => 10,  83 => 9,  59 => 7,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_permissions.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\access_permissions\\views\\gentelella\\helper_permissions.twig");
    }
}
