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

/* helper_lang_select_sidebox.twig */
class __TwigTemplate_9a3a471087ebc13fa0192988bcd1c80168aadadfc7fc7d35c494afd3d97d47e7 extends \Twig\Template
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
        echo "<div id=\"lang-block\">
    <div class=\"lang-block-header\" data-bind=\"langheader\">
        ";
        // line 3
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("text_language"        ,"users"        ,        );
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
    <ul>
        ";
        // line 6
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 7
            echo "            ";
            if (($this->getAttribute($context["item"], "status", []) == "1")) {
                // line 8
                echo "            <li ";
                if (($this->getAttribute($context["item"], "id", []) == ($context["current_lang"] ?? null))) {
                    echo "class=\"lbi-selected\"";
                }
                echo " role=\"presentation\" data-code=\"";
                echo $this->getAttribute($context["item"], "code", []);
                echo "\"
                data-id=\"";
                // line 9
                echo $this->getAttribute($context["item"], "id", []);
                echo "\">";
                echo $this->getAttribute($context["item"], "name", []);
                echo "
            </li>
            ";
            }
            // line 12
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "    </ul>
</div>
<script>
    \$(function() {
        \$('#lang-block li').on('click touchstart', function(event){
            event.stopPropagation();
            event.preventDefault();

            var lang_id = \$(this).data('id')
            location.href = site_url + 'users/change_language/' + lang_id;
        });
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "helper_lang_select_sidebox.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  89 => 13,  83 => 12,  75 => 9,  66 => 8,  63 => 7,  59 => 6,  55 => 4,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_lang_select_sidebox.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\users\\views\\flatty\\helper_lang_select_sidebox.twig");
    }
}
