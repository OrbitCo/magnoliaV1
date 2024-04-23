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

/* oauth_login.twig */
class __TwigTemplate_a9d32f07cdc8d2d6363d03910a80551dafe47340dde955b4c35d9762e3480bfa extends \Twig\Template
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
        if ((twig_length_filter($this->env, ($context["services"] ?? null)) > 0)) {
            // line 2
            echo "<div class=\"oauth-links mb10\">
    <div class=\"mr5 mb10\">
        ";
            // line 4
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("sign_in_with"            ,"users_connections"            ,            );
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
            echo ":
    </div>
    <ins>
        ";
            // line 7
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["services"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 8
                echo "        ";
                if (($context["TRIAL_MODE"] ?? null)) {
                    // line 9
                    echo "        <a href=\"javascript:void(0);\" class=\"btn btn-primary ";
                    echo $this->getAttribute($context["item"], "gid", []);
                    echo "\" data-html=\"true\" title=\"Social networks login does not work in demo version\" data-toggle=\"tooltip\">
            ";
                } else {
                    // line 11
                    echo "            <a href=\"";
                    echo ($context["site_url"] ?? null);
                    echo "users_connections/oauth_login/";
                    echo $this->getAttribute($context["item"], "id", []);
                    echo "\" class=\"btn btn-primary ";
                    echo $this->getAttribute($context["item"], "gid", []);
                    echo "\" data-pjax=\"0\" title=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "name", []));
                    echo "\">
                ";
                }
                // line 13
                echo "                ";
                if (($this->getAttribute($context["item"], "gid", []) == "facebook")) {
                    // line 14
                    echo "                <i class=\"fab fa-facebook-f\"></i>
                ";
                } elseif (($this->getAttribute(                // line 15
$context["item"], "gid", []) == "vkontakte")) {
                    // line 16
                    echo "                <i class=\"fab fa-vk\"></i>
                ";
                } elseif (($this->getAttribute(                // line 17
$context["item"], "gid", []) == "google")) {
                    // line 18
                    echo "                <i class=\"fab fa-google\"></i>
                ";
                } elseif (($this->getAttribute(                // line 19
$context["item"], "gid", []) == "linkedin")) {
                    // line 20
                    echo "                <i class=\"fab fa-linkedin-in\"></i>
                ";
                } elseif (($this->getAttribute(                // line 21
$context["item"], "gid", []) == "twitter")) {
                    // line 22
                    echo "                <i class=\"fab fa-twitter\"></i>
                ";
                }
                // line 24
                echo "            </a>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 26
            echo "    </ins>
</div>
<script>
\$(function() {
    if (typeof tooltip == 'function') {
        \$('.oauth-links [data-toggle=\"tooltip\"]').tooltip({ placement: 'bottom' });
    }
});
</script>
<style>
.oauth-links .tooltip {
    text-transform: initial;
}
</style>
";
        }
    }

    public function getTemplateName()
    {
        return "oauth_login.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  120 => 26,  113 => 24,  109 => 22,  107 => 21,  104 => 20,  102 => 19,  99 => 18,  97 => 17,  94 => 16,  92 => 15,  89 => 14,  86 => 13,  74 => 11,  68 => 9,  65 => 8,  61 => 7,  36 => 4,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "oauth_login.twig", "/home/mliadov/public_html/application/modules/users_connections/views/flatty/oauth_login.twig");
    }
}
