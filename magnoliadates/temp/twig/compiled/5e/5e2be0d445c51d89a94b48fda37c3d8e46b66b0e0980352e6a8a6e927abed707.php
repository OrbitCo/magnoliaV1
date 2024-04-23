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

/* users.twig */
class __TwigTemplate_b2e75df135ecffc01875c903b713ab3fb7782612c6ccb6f5eecb915287473059 extends \Twig\Template
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
        echo "<div class=\"like_users\">
    <div class=\"lh0 ";
        // line 2
        if ((twig_length_filter($this->env, ($context["like_users"] ?? null)) > 14)) {
            echo "w-scroll";
        }
        echo "\">
        ";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["like_users"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 4
            echo "            ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("text_user_logo"            ,"likes"            ,""            ,"button"            ,($context["user"] ?? null)            ,            );
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
            $context['text_user_logo'] = $result;
            // line 5
            echo "            <a data-action=\"set_user_ids\" data-gid=\"likes\"  id=\"like_user_";
            echo $this->getAttribute($context["user"], "id", []);
            echo "\" data-href=\"";
            echo $this->getAttribute($context["user"], "link", []);
            echo "\" href=\"#\"
               title=\"";
            // line 6
            echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "output_name", []));
            echo "\">
                <img src=\"";
            // line 7
            echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["user"], "media", []), "user_logo", []), "thumbs", []), "small", []);
            echo "\"
                     alt=\"";
            // line 8
            echo ($context["text_user_logo"] ?? null);
            echo "\" title=\"";
            echo ($context["text_user_logo"] ?? null);
            echo "\">
            </a>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['user'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 11
        echo "    </div>
    ";
        // line 12
        if (($context["has_more"] ?? null)) {
            // line 13
            echo "        <ul class=\"centered\">
            <li class=\"a like_more_btn\">
                ";
            // line 15
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_view_more"            ,"start"            ,            );
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
            echo "            </li>
        </ul>
    ";
        }
        // line 19
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "users.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  126 => 19,  121 => 16,  100 => 15,  96 => 13,  94 => 12,  91 => 11,  80 => 8,  76 => 7,  72 => 6,  65 => 5,  43 => 4,  39 => 3,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "users.twig", "/home/mliadov/public_html/application/modules/likes/views/flatty/users.twig");
    }
}
