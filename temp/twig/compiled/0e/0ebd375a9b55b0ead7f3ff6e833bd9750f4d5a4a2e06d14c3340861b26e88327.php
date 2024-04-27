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

/* helper_flipping_profiles.twig */
class __TwigTemplate_43e4d4beddef90b4c9f7256801fa903c649f620bfa51494ccba9dbfe00625109 extends \Twig\Template
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
        echo "<div class=\"magazine-profile__likemepanel likemecontrols\">
    <a href='";
        // line 2
        if (twig_test_empty($this->getAttribute(($context["flipping_navigation"] ?? null), "prev", []))) {
            echo "javascript:;";
        } else {
            echo $this->getAttribute(($context["flipping_navigation"] ?? null), "prev", []);
        }
        echo "' 
       class=\"profile_navigation likemecontrols__item ";
        // line 3
        if (twig_test_empty($this->getAttribute(($context["flipping_navigation"] ?? null), "prev", []))) {
            echo "inactive";
        }
        echo "\">
        <span class=\"fa fa-chevron-left\"></span>&nbsp;";
        // line 4
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("magazine_navigation_prev"        ,"users"        ,        );
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
        // line 5
        echo "    </a>
    <a href='";
        // line 6
        if (twig_test_empty($this->getAttribute(($context["flipping_navigation"] ?? null), "next", []))) {
            echo "javascript:;";
        } else {
            echo $this->getAttribute(($context["flipping_navigation"] ?? null), "next", []);
        }
        echo "' 
       class=\"profile_navigation likemecontrols__item ";
        // line 7
        if (twig_test_empty($this->getAttribute(($context["flipping_navigation"] ?? null), "next", []))) {
            echo "inactive";
        }
        echo "\">
        ";
        // line 8
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("magazine_navigation_next"        ,"users"        ,        );
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
        echo "&nbsp;<span class=\"fa fa-chevron-right\"></span>  
    </a>                    
</div>";
    }

    public function getTemplateName()
    {
        return "helper_flipping_profiles.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  85 => 8,  79 => 7,  71 => 6,  68 => 5,  47 => 4,  41 => 3,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_flipping_profiles.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\users\\views\\flatty\\helper_flipping_profiles.twig");
    }
}
