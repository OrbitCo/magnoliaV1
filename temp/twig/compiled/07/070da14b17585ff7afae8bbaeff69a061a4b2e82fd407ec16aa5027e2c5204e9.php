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

/* profile_magazine.twig */
class __TwigTemplate_0d43e25a89222da0db6f65eb127ff5ab7c6e5e05cadb04d598bf61a15a861496 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "profile_magazine.twig", 1)->display($context);
        // line 2
        echo "</div></div>

";
        // line 4
        if ((((($context["action"] ?? null) == "view") || (($context["action"] ?? null) == "wall")) || (($context["action"] ?? null) == "gallery"))) {
            // line 5
            echo "    ";
            $this->loadTemplate("user_profile_magazine.twig", "profile_magazine.twig", 5)->display(twig_array_merge($context, ["is_owner" => ($context["is_owner"] ?? null)]));
        } else {
            // line 7
            echo "    ";
            $this->loadTemplate("user_form.twig", "profile_magazine.twig", 7)->display($context);
        }
        // line 9
        echo "
";
        // line 10
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array(""        ,"datepicker-dropdown-template.js"        ,        );
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
        // line 11
        echo "
<div class=\"container\"><div class=\"row\">
";
        // line 13
        $this->loadTemplate("@app/footer.twig", "profile_magazine.twig", 13)->display($context);
    }

    public function getTemplateName()
    {
        return "profile_magazine.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  74 => 13,  70 => 11,  49 => 10,  46 => 9,  42 => 7,  38 => 5,  36 => 4,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "profile_magazine.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\users\\views\\flatty\\profile_magazine.twig");
    }
}
