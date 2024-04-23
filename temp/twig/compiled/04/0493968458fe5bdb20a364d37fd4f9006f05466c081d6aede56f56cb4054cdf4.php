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

/* mark_as_spam_form.twig */
class __TwigTemplate_36d87dac5e08a1f641606a92a701a81e36d30a82ae4445a86cd95dbe4cc2508f extends \Twig\Template
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
        echo "<div class=\"content-block load_content\">
\t<h1>
        ";
        // line 3
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_spam_form"        ,"spam"        ,        );
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
        // line 4
        echo "    </h1>
\t<div class=\"inside edit_block\">
\t\t<form id=\"spam_form\" action=\"\" method=\"POST\">
\t\t\t";
        // line 7
        if (($this->getAttribute(($context["data"] ?? null), "form_type", []) == "select_text")) {
            // line 8
            echo "                <div class=\"form-group\">
                    <label>
                        ";
            // line 10
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_spam_reason"            ,"spam"            ,            );
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
            echo "&nbsp;*
                    </label>
                    <select name=\"data[id_reason]\" class=\"form-control\">
                        ";
            // line 13
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["reasons"] ?? null), "option", []));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 14
                echo "                            <option value=\"";
                echo twig_escape_filter($this->env, $context["key"]);
                echo "\">
                                ";
                // line 15
                echo $context["item"];
                echo "
                            </option>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 18
            echo "                    </select>
                </div>
                <div class=\"form-group\">
                    <label>
                        ";
            // line 22
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_spam_message"            ,"spam"            ,            );
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
            echo "&nbsp;
                        (";
            // line 23
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_spam_optional"            ,"spam"            ,            );
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
            echo ")
                    </label>
                    <textarea name=\"data[message]\" rows=\"5\" cols=\"23\"
                              class=\"form-control\"></textarea>
                </div>
            ";
        }
        // line 29
        echo "
\t\t\t<button id=\"close_btn\" class=\"btn btn-primary\">
                ";
        // line 31
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_send"        ,"start"        ,""        ,"button"        ,        );
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
        // line 32
        echo "            </button>

\t\t\t<input type=\"hidden\" name=\"type_gid\" value=\"";
        // line 34
        echo $this->getAttribute(($context["data"] ?? null), "gid", []);
        echo "\" />
\t\t\t<input type=\"hidden\" name=\"object_id\" value=\"";
        // line 35
        echo ($context["object_id"] ?? null);
        echo "\" />

            ";
        // line 37
        if (($context["is_spam_owner"] ?? null)) {
            // line 38
            echo "                <input type=\"hidden\" name=\"is_owner\" value=\"1\">
            ";
        }
        // line 40
        echo "\t\t</form>
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "mark_as_spam_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  210 => 40,  206 => 38,  204 => 37,  199 => 35,  195 => 34,  191 => 32,  170 => 31,  166 => 29,  138 => 23,  115 => 22,  109 => 18,  100 => 15,  95 => 14,  91 => 13,  66 => 10,  62 => 8,  60 => 7,  55 => 4,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "mark_as_spam_form.twig", "/home/mliadov/public_html/application/modules/spam/views/flatty/mark_as_spam_form.twig");
    }
}
