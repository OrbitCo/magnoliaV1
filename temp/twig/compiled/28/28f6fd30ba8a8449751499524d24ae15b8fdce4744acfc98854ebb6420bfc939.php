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

/* helper_pagination.twig */
class __TwigTemplate_08d2675b31eede7c4ff15f4af21d8718c6dcbe8f7efa8f9debd92c23ac6ea22c extends \Twig\Template
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
        if ((($context["page_type"] ?? null) == "cute")) {
            // line 2
            echo "    <div class=\"pages\">
        <div class=\"inside\">
            <ins class=\"current\">
                ";
            // line 5
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("text_pages"            ,"start"            ,            );
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
            echo " ";
            echo $this->getAttribute(($context["page_data"] ?? null), "cur_page", []);
            echo "
                ";
            // line 6
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("text_of"            ,"start"            ,            );
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
            echo " ";
            echo $this->getAttribute(($context["page_data"] ?? null), "total_pages", []);
            echo "
            </ins>
                &nbsp;
                <a href=\"";
            // line 9
            echo $this->getAttribute(($context["page_data"] ?? null), "base_url", []);
            echo $this->getAttribute(($context["page_data"] ?? null), "prev_page", []);
            echo "\" class=\"";
            if (($this->getAttribute(($context["page_data"] ?? null), "prev_page", []) == $this->getAttribute(($context["page_data"] ?? null), "cur_page", []))) {
                echo "gray";
            }
            echo "\">
                    ";
            // line 10
            if (($this->getAttribute(($context["_LANG"] ?? null), "rtl", []) == "rtl")) {
                echo "<i class=\"fa fa-caret-right\"></i>";
            } else {
                echo "<i class=\"fa fa-caret-left\"></i>";
            }
            // line 11
            echo "                </a>
                &nbsp;
                <a href=\"";
            // line 13
            echo $this->getAttribute(($context["page_data"] ?? null), "base_url", []);
            echo $this->getAttribute(($context["page_data"] ?? null), "next_page", []);
            echo "\" class=\"";
            if (($this->getAttribute(($context["page_data"] ?? null), "next_page", []) == $this->getAttribute(($context["page_data"] ?? null), "cur_page", []))) {
                echo "gray";
            }
            echo "\">
                    ";
            // line 14
            if (($this->getAttribute(($context["_LANG"] ?? null), "rtl", []) == "rtl")) {
                echo "<i class=\"fa fa-caret-left\"></i>";
            } else {
                echo "<i class=\"fa fa-caret-right\"></i>";
            }
            // line 15
            echo "                </a>
        </div>
    </div>
";
        } elseif (((        // line 18
($context["page_type"] ?? null) == "full") && $this->getAttribute(($context["page_data"] ?? null), "nav", []))) {
            // line 19
            echo "    <ul class=\"pagination\">
        ";
            // line 20
            echo $this->getAttribute(($context["page_data"] ?? null), "nav", []);
            echo "
    </ul>
";
        } elseif (((        // line 22
($context["page_type"] ?? null) == "scroll") && (($context["page_items"] ?? null) == "next"))) {
            // line 23
            echo "        <div class=\"button-cont ";
            if (($this->getAttribute(($context["page_data"] ?? null), "cur_page", []) == $this->getAttribute(($context["page_data"] ?? null), "total_pages", []))) {
                echo "hide";
            }
            echo " mt20\">
            <input data-action=\"show-more\" class=\"btn btn-cancel form-control\" type=\"button\" value=\"";
            // line 24
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("show_more"            ,"start"            ,""            ,"button"            ,            );
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
            echo "\" />
        </div>
";
        } elseif (((        // line 26
($context["page_type"] ?? null) == "scroll") && (($context["page_items"] ?? null) == "previous"))) {
            // line 27
            echo "        <div class=\"button-cont ";
            if (($this->getAttribute(($context["page_data"] ?? null), "cur_page", []) == $this->getAttribute(($context["page_data"] ?? null), "prev_page", []))) {
                echo "hide";
            }
            echo " mt20\">
            <input data-action=\"show-previous\" class=\"btn btn-cancel form-control\" type=\"button\" value=\"";
            // line 28
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("show_previous"            ,"start"            ,""            ,"button"            ,            );
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
            echo "\" />
        </div>
";
        }
    }

    public function getTemplateName()
    {
        return "helper_pagination.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  180 => 28,  173 => 27,  171 => 26,  147 => 24,  140 => 23,  138 => 22,  133 => 20,  130 => 19,  128 => 18,  123 => 15,  117 => 14,  108 => 13,  104 => 11,  98 => 10,  89 => 9,  62 => 6,  37 => 5,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_pagination.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\start\\views\\flatty\\helper_pagination.twig");
    }
}
