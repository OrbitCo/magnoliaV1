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

/* helper_count.twig */
class __TwigTemplate_d17343e8104c8f45f2b79d47d02ef22fb3bb8ed7981d4c459cf60e6e3236366c extends \Twig\Template
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
        echo "<label class=\"btn btn-default";
        if ((($context["filter"] ?? null) == "all")) {
            echo " active";
        }
        if ( !$this->getAttribute(($context["filter_data"] ?? null), "all", [])) {
            echo " disabled";
        }
        echo "\"
       data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\"
       onclick=\"";
        // line 3
        if ($this->getAttribute(($context["filter_data"] ?? null), "all", [])) {
            echo " document.location.href='";
            echo ($context["site_url"] ?? null);
            echo "admin/ausers/index/all'";
        } else {
            echo "return false;";
        }
        echo "\">
    <input type=\"radio\" name=\"user_type\"";
        // line 4
        if ((($context["filter"] ?? null) == "all")) {
            echo " selected";
        }
        echo ">
    ";
        // line 5
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_all_users"        ,"ausers"        ,        );
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
        echo " (";
        echo $this->getAttribute(($context["count_data"] ?? null), "all", []);
        echo ")
</label>
<label class=\"btn btn-default";
        // line 7
        if ((($context["filter"] ?? null) == "moderator")) {
            echo " active";
        }
        if ( !$this->getAttribute(($context["filter_data"] ?? null), "moderator", [])) {
            echo " disabled";
        }
        echo "\"
       data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\"
       onclick=\"";
        // line 9
        if ($this->getAttribute(($context["filter_data"] ?? null), "moderator", [])) {
            echo "document.location.href='";
            echo ($context["site_url"] ?? null);
            echo "admin/moderators/'";
        } else {
            echo "return false;";
        }
        echo "\">
    <input type=\"radio\" name=\"user_type\"";
        // line 10
        if ((($context["filter"] ?? null) == "admin")) {
            echo " selected";
        }
        echo ">
    ";
        // line 11
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_moderator_users"        ,"ausers"        ,        );
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
        echo " (";
        echo $this->getAttribute(($context["count_data"] ?? null), "moderators", []);
        echo ")
</label>
";
    }

    public function getTemplateName()
    {
        return "helper_count.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  109 => 11,  103 => 10,  93 => 9,  83 => 7,  57 => 5,  51 => 4,  41 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_count.twig", "/home/mliadov/public_html/application/modules/moderators/views/gentelella/helper_count.twig");
    }
}
