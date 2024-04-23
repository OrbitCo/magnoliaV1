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

/* decorator_user_logo.twig */
class __TwigTemplate_92f3c791cdce14feb5dbf4953d0414ef45efb0c071fec950915e6ba46ed46018 extends \Twig\Template
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
        echo "<picture>
    ";
        // line 2
        if ( !twig_test_empty($this->getAttribute(($context["logo_params"] ?? null), "thumbs_webp", []))) {
            // line 3
            echo "        <source data-srcset=\"";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["logo_params"] ?? null), "thumbs_webp", []));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["thumb"]) {
                if (($this->getAttribute($context["loop"], "first", []) == false)) {
                    echo ", ";
                }
                echo $this->getAttribute($context["thumb"], "file_url", []);
                echo " ";
                echo $this->getAttribute($context["thumb"], "file_width", []);
                echo "w";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['thumb'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo "\" type=\"image/webp\" media=\"(max-width: ";
            echo $this->getAttribute(($context["logo_params"] ?? null), "max_width", []);
            echo "px)\">
    ";
        }
        // line 5
        echo "    <source data-srcset=\"";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["logo_params"] ?? null), "thumbs", []));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["thumb"]) {
            if (($this->getAttribute($context["loop"], "first", []) == false)) {
                echo ", ";
            }
            echo $this->getAttribute($context["thumb"], "file_url", []);
            echo " ";
            echo $this->getAttribute($context["thumb"], "file_width", []);
            echo "w";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['thumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo "\" type=\"";
        echo $this->getAttribute(($context["logo_params"] ?? null), "mime", []);
        echo "\" media=\"(max-width: ";
        echo $this->getAttribute(($context["logo_params"] ?? null), "max_width", []);
        echo "px)\">
    <img src=\"";
        // line 6
        echo ($context["site_root"] ?? null);
        echo "uploads/default/";
        echo $this->getAttribute(($context["logo_params"] ?? null), "size_name", []);
        echo "-default-user-logo.png\"
         data-src=\"";
        // line 7
        echo $this->getAttribute(($context["logo_params"] ?? null), "src", []);
        echo "\"
         alt=\"";
        // line 8
        echo $this->getAttribute(($context["logo_params"] ?? null), "alt", []);
        echo "\"
         title=\"";
        // line 9
        echo $this->getAttribute(($context["logo_params"] ?? null), "title", []);
        echo "\"
         class=\"";
        // line 10
        if ($this->getAttribute(($context["logo_params"] ?? null), "class", [])) {
            echo $this->getAttribute(($context["logo_params"] ?? null), "class", []);
            echo " img-responsive";
        }
        echo " lazyload lazy-";
        echo $this->getAttribute(($context["logo_params"] ?? null), "size_name", []);
        echo "\"
         data-size=\"";
        // line 11
        echo $this->getAttribute(($context["logo_params"] ?? null), "size_name", []);
        echo "\"/>
</picture>
";
        // line 13
        if ($this->getAttribute(($context["logo_params"] ?? null), "online_status", [])) {
            // line 14
            echo "    <div class=\"c-online-icon ";
            echo $this->getAttribute(($context["logo_params"] ?? null), "size_name", []);
            echo "  ";
            if (($this->getAttribute(($context["logo_params"] ?? null), "size_name", []) == "grand")) {
                echo " logo ";
            }
            echo "\" title=\"";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("status_online_1"            ,"users"            ,""            ,"button"            ,            );
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
            echo "\">
        <span>";
            // line 15
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("status_online_1"            ,"users"            ,""            ,"button"            ,            );
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
            echo "</span>
    </div>
";
        }
    }

    public function getTemplateName()
    {
        return "decorator_user_logo.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  184 => 15,  154 => 14,  152 => 13,  147 => 11,  138 => 10,  134 => 9,  130 => 8,  126 => 7,  120 => 6,  77 => 5,  35 => 3,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "decorator_user_logo.twig", "/home/mliadov/public_html/application/modules/users/views/flatty/decorator_user_logo.twig");
    }
}
