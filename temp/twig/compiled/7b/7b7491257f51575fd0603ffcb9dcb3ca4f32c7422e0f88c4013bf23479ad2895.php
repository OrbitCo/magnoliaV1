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

/* profile_untitled.twig */
class __TwigTemplate_8850fcaf0f9ac140e64aee5a5029ae7a30d51869f17895a087a06f4d563a47f3 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "profile_untitled.twig", 1)->display($context);
        // line 2
        echo "
<div class=\"content-block\">
    <div class=\"view small\">
        <div class=\"col-xs-12 col-sm-2\">
            <div class=\"image\">
                <div class=\"mb20\">
                    <img class=\"img-rounded img-responsive\" src=\"";
        // line 8
        echo ($context["site_root"] ?? null);
        echo "uploads/default/midle-default-user-logo-deleted.png\">
                </div>
            </div>
        </div>
        <div class=\"col-xs-12 col-sm-10\">
            <h1>
                ";
        // line 14
        if ($this->getAttribute(($context["data"] ?? null), "id", [])) {
            // line 15
            echo "                    ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("profile_blocked"            ,"users"            ,            );
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
            // line 16
            echo "                ";
        } else {
            // line 17
            echo "                    ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("profile_deleted"            ,"users"            ,            );
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
            // line 18
            echo "                ";
        }
        // line 19
        echo "            </h1>
        </div>
    </div>
</div>
<div class=\"clr\"></div>

";
        // line 25
        $this->loadTemplate("@app/footer.twig", "profile_untitled.twig", 25)->display($context);
    }

    public function getTemplateName()
    {
        return "profile_untitled.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  109 => 25,  101 => 19,  98 => 18,  76 => 17,  73 => 16,  51 => 15,  49 => 14,  40 => 8,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "profile_untitled.twig", "/home/mliadov/public_html/application/modules/users/views/flatty/profile_untitled.twig");
    }
}
