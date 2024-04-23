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
class __TwigTemplate_1aac68db282669790f7d9f0e78d0fbe71dbbd306325bfb03660fd0d465d94a45 extends \Twig\Template
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
        echo "<div class=\"form-group\">
    <label>";
        // line 2
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_payment_user"        ,"payments"        ,        );
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
        // line 3
        if ($this->getAttribute($this->getAttribute(($context["data"] ?? null), "user", []), "output_name", [])) {
            // line 4
            echo "        ";
            if ($this->getAttribute($this->getAttribute(($context["data"] ?? null), "user", []), "is_deleted", [])) {
                // line 5
                echo "            ";
                echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "user", []), "output_name", []);
                echo "
        ";
            } else {
                // line 7
                echo "            <a href=\"";
                echo ($context["site_url"] ?? null);
                echo "admin/users/edit/personal/";
                echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "user", []), "id", []);
                echo "\" target=\"_blank\" >";
                echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "user", []), "output_name", []);
                echo "</a>
        ";
            }
            // line 9
            echo "    ";
        } else {
            // line 10
            echo "        ";
            if ($this->getAttribute($this->getAttribute(($context["data"] ?? null), "user", []), "is_deleted", [])) {
                // line 11
                echo "            ";
                echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "user", []), "nickname", []);
                echo "
        ";
            } else {
                // line 13
                echo "            <a href=\"";
                echo ($context["site_url"] ?? null);
                echo "admin/users/edit/personal/";
                echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "user", []), "id", []);
                echo "\" target=\"_blank\" >";
                echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "user", []), "nickname", []);
                echo "</a>
        ";
            }
            // line 15
            echo "    ";
        }
        echo "    
    <br>
    <label>";
        // line 17
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_payment_amount"        ,"payments"        ,        );
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
        $module =         null;
        $helper =         'start';
        $name =         'currency_format_output';
        $params = array(["value" => $this->getAttribute(($context["data"] ?? null), "amount", [])]        ,        );
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
        echo "<br>
    <label>";
        // line 18
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_payment_type"        ,"payments"        ,        );
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
        echo "</label> ";
        echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "payment_data", []), "name", []);
        echo "<br>
    ";
        // line 19
        if ($this->getAttribute($this->getAttribute(($context["data"] ?? null), "payment_data", []), "comment", [])) {
            // line 20
            echo "        <label>";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("html_field_comment"            ,"payments"            ,            );
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
            echo "</label><br>";
            echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "payment_data", []), "comment", []);
            echo "<br>
    ";
        }
        // line 22
        echo "</div>
<div class=\"form-group\">
    ";
        // line 24
        if (($this->getAttribute(($context["data"] ?? null), "dashboard_status", []) == "payment_sended")) {
            // line 25
            echo "        <a class=\"btn btn-success-ghost js-dashboard-action\" href=\"";
            echo ($context["site_url"] ?? null);
            echo "admin/payments/payment_status/approve/";
            echo $this->getAttribute(($context["data"] ?? null), "id", []);
            echo "/1\">
            <i class=\"fa fa-check\" aria-hidden=\"true\"></i>  ";
            // line 26
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_payment_approve"            ,"payments"            ,            );
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
            echo "</a>
        <a class=\"btn btn-danger-ghost js-dashboard-action\" href=\"";
            // line 27
            echo ($context["site_url"] ?? null);
            echo "admin/payments/payment_status/decline/";
            echo $this->getAttribute(($context["data"] ?? null), "id", []);
            echo "/0\">
            <i class=\"fa fa-ban\" aria-hidden=\"true\"></i>  ";
            // line 28
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_payment_decline"            ,"payments"            ,            );
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
            echo "</a>
        ";
        } else {
            // line 30
            echo "        <label>";
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
            $params = array(("status_" . $this->getAttribute(($context["data"] ?? null), "dashboard_status", []))            ,"payments"            ,            );
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
            // line 31
            echo "    ";
        }
        // line 32
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
        return array (  315 => 32,  312 => 31,  269 => 30,  245 => 28,  239 => 27,  216 => 26,  209 => 25,  207 => 24,  203 => 22,  176 => 20,  174 => 19,  149 => 18,  105 => 17,  99 => 15,  89 => 13,  83 => 11,  80 => 10,  77 => 9,  67 => 7,  61 => 5,  58 => 4,  56 => 3,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "dashboard.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\payments\\views\\gentelella\\dashboard.twig");
    }
}
