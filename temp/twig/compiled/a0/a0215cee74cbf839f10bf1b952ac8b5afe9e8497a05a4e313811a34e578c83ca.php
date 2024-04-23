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

/* index.twig */
class __TwigTemplate_19c2162147f835feb14cab0480134c6a1a7df263fc09bc2abb50a56dd1a07ead extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "index.twig", 1)->display($context);
        // line 2
        echo "<div class=\"col-md-12 col-sm-12 col-xs-12\">
    ";
        // line 3
        if (($this->getAttribute(($context["role"] ?? null), "role", []) != "guest")) {
            // line 4
            echo "        <div class=\"action-block\">
            <div class=\"col-xs-12\">
                ";
            // line 6
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["subscription_type"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 7
                echo "                    ";
                if ((((($context["count_user_types"] ?? null) > 0) && ($this->getAttribute($context["item"], "type", []) == "user_types")) || ($this->getAttribute($context["item"], "type", []) != "user_types"))) {
                    // line 8
                    echo "                    <div class=\"row pull-left mrb20\">
                        <div class=\"checkbox-inline\">
                            <label>
                                <input onclick=\"";
                    // line 11
                    $module =                     null;
                    $helper =                     'start';
                    $name =                     'setAnalytics';
                    $params = array("access_permissions"                    ,("radio_" . $this->getAttribute(($context["item"] ?? null), "type", []))                    ,                    );
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
                    echo "\" type=\"radio\" name=\"subscription_type[";
                    echo $this->getAttribute($context["item"], "type", []);
                    echo "]\" data-value=\"";
                    echo $this->getAttribute($context["item"], "data", []);
                    echo "\" data-type=\"";
                    echo $this->getAttribute($context["item"], "type", []);
                    echo "\" ";
                    if ($this->getAttribute($context["item"], "data", [])) {
                        echo "checked";
                    }
                    echo " data-user_type=\"";
                    echo $this->getAttribute(($context["role"] ?? null), "type", []);
                    echo "\" class=\"flat subscription_type-js\">
                                ";
                    // line 12
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array(("field_subscription_type_" . $this->getAttribute(($context["item"] ?? null), "type", []))                    ,"access_permissions"                    ,                    );
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
                    echo "</label>
                        </div>
                    </div>
                    ";
                }
                // line 16
                echo "                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 17
            echo "            </div>
        </div>
    ";
        }
        // line 20
        echo "    <div class=\"x_panel\">
        <div id=\"access-content\">            
            ";
        // line 22
        $this->loadTemplate("list_settings.twig", "index.twig", 22)->display($context);
        // line 23
        echo "        </div>
    </div>
</div>
";
        // line 26
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("access_permissions"        ,"AdminAccessPermissions.js"        ,""        ,"sync"        ,        );
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
        // line 27
        echo "<script type='text/javascript'>
    \$(function () {
        new AdminAccessPermissions({
            siteUrl: '";
        // line 30
        echo ($context["site_root"] ?? null);
        echo "'
        });
    });
</script>
";
        // line 34
        $this->loadTemplate("@app/footer.twig", "index.twig", 34)->display($context);
    }

    public function getTemplateName()
    {
        return "index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  169 => 34,  162 => 30,  157 => 27,  136 => 26,  131 => 23,  129 => 22,  125 => 20,  120 => 17,  114 => 16,  88 => 12,  53 => 11,  48 => 8,  45 => 7,  41 => 6,  37 => 4,  35 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "index.twig", "/home/mliadov/public_html/application/modules/access_permissions/views/gentelella/index.twig");
    }
}
