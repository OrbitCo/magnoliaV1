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

/* helper_lang_select_xs.twig */
class __TwigTemplate_2891949dcb94639d8d2b09338100cc3dfc64181c5c303153d9912a1401bfc450 extends \Twig\Template
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
        if ((($context["count_active"] ?? null) > 1)) {
            // line 2
            echo "    <div class=\"xs-menu-title\">
        ";
            // line 3
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("xs_menu_home_language"            ,"users"            ,            );
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
            echo "    </div>
    <select class=\"form-control\" onchange=\"";
            // line 5
            $module =             null;
            $helper =             'start';
            $name =             'setAnalytics';
            $params = array("right_top_menu"            ,"language_switch"            ,            );
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
            echo " locationHref('";
            echo ($context["site_url"] ?? null);
            echo "languages/change_lang/' + this.value); \" >
        ";
            // line 6
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 7
                echo "            ";
                if (($this->getAttribute($context["item"], "status", []) == "1")) {
                    // line 8
                    echo "                <option value=\"";
                    echo $this->getAttribute($context["item"], "id", []);
                    echo "\" ";
                    if (($this->getAttribute($context["item"], "id", []) == ($context["current_lang"] ?? null))) {
                        echo "selected";
                    }
                    echo ">
                    ";
                    // line 9
                    echo $this->getAttribute($context["item"], "name", []);
                    echo "
                </option>
            ";
                }
                // line 12
                echo "        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 13
            echo "    </select>
";
        }
    }

    public function getTemplateName()
    {
        return "helper_lang_select_xs.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  112 => 13,  106 => 12,  100 => 9,  91 => 8,  88 => 7,  84 => 6,  59 => 5,  56 => 4,  35 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_lang_select_xs.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\languages\\views\\flatty\\helper_lang_select_xs.twig");
    }
}
