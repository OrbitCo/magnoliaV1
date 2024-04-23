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

/* helper_likes.twig */
class __TwigTemplate_242108e90fd20a83e41f500bf3ac0cf9906c757b2aea9ec6be2cd90af959bb66 extends \Twig\Template
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
        echo "<script>
\t\$(function(){
\t\tvar data = ";
        // line 3
        echo twig_jsonencode_filter(($context["likes_helper_data"] ?? null));
        echo ";
\t\tloadScripts(
\t\t\t'";
        // line 5
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("likes"        ,"../views/flatty/js/likes.js"        ,"path"        ,        );
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
        echo "',
\t\t\tfunction(){
\t\t\t\tlikes = new Likes({
\t\t\t\t\tsiteUrl: site_url,
\t\t\t\t\tlikeTitle: data.like_title,
\t\t\t\t\tcanLike: data.can_like
\t\t\t\t});
\t\t\t},
\t\t\t'',
\t\t\t{async: true}
\t\t);
\t});
</script>
";
    }

    public function getTemplateName()
    {
        return "helper_likes.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 5,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_likes.twig", "/home/mliadov/public_html/application/modules/likes/views/flatty/helper_likes.twig");
    }
}
