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

/* ajax_notify.twig */
class __TwigTemplate_98bcf99011696e5892a0c051bbe7f2b9b3c3114a9d6147e62478d6b3113d4aa2 extends \Twig\Template
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
        echo "<div class=\"content-block load_content center\">
    <h1>
        ";
        // line 3
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_header_congratulations"        ,"like_me"        ,        );
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
        echo "    </h1>
    <h3>
        ";
        // line 6
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_congratulations"        ,"like_me"        ,        );
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
        // line 7
        echo "    </h3>
    <div class=\"inside \">
        <div class=\"congratulations\">
            <div class=\"pos-rel m10 ptb20\">
                ";
        // line 11
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["user_data"] ?? null), "users", []));
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
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 12
            echo "                    <div class=\"p5 ";
            if (($this->getAttribute($context["loop"], "index", []) == 1)) {
                echo "first-liked";
            } else {
                echo "second-liked";
            }
            echo "\">
                        <img src=\"";
            // line 13
            echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["item"], "media", []), "user_logo", []), "thumbs", []), "big", []);
            echo "\"
                             alt=\"";
            // line 14
            echo $this->getAttribute($context["item"], "output_name", []);
            echo "\"
                             title=\"";
            // line 15
            echo $this->getAttribute($context["item"], "output_name", []);
            echo "\">
                        <div>";
            // line 16
            echo $this->getAttribute($context["item"], "output_name", []);
            echo "</div>
                    </div>
                ";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 19
        echo "            </div>
            <div class=\"clr\"></div>

            <div class=\"mt20 pt10\">
                ";
        // line 23
        echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["user_data"] ?? null), "settings", []), "chat_message", []), ($context["lang_id"] ?? null), [], "array");
        echo "
            </div>

            <div class=\"mt20 congratulations__buttons\">
                ";
        // line 27
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute(($context["user_data"] ?? null), "settings", []), "chat_more", []));
        foreach ($context['_seq'] as $context["key"] => $context["set"]) {
            // line 28
            echo "                    ";
            if ( !twig_test_empty($this->getAttribute($context["set"], "helper", []))) {
                // line 29
                echo "                        <span class=\"congratulations__buttons-in\" data-name=\"";
                echo $this->getAttribute($context["set"], "name", []);
                echo "\" data-action=\"close-block\">
                            ";
                // line 30
                $module =                 null;
                $helper = $context["key"];
                $name = $this->getAttribute($context["set"], "helper", []);
                $params = array(["id_user" => $this->getAttribute(                // line 31
($context["user_data"] ?? null), "profile_id", []), "user_id" => $this->getAttribute(                // line 32
($context["user_data"] ?? null), "profile_id", []), "id_contact" => $this->getAttribute(                // line 33
($context["user_data"] ?? null), "profile_id", []), "new_tab" => 1]                ,                );
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
                // line 36
                echo "                        </span>
                    ";
            }
            // line 38
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['set'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 39
        echo "                <input id=\"keep_playing\" type=\"button\" name=\"keep_playing\" value=\"";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("button_keep_playing"        ,"like_me"        ,        );
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
        echo "\" class=\"btn btn-primary\">
            </div>
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "ajax_notify.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  200 => 39,  194 => 38,  190 => 36,  172 => 33,  171 => 32,  170 => 31,  166 => 30,  161 => 29,  158 => 28,  154 => 27,  147 => 23,  141 => 19,  124 => 16,  120 => 15,  116 => 14,  112 => 13,  103 => 12,  86 => 11,  80 => 7,  59 => 6,  55 => 4,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "ajax_notify.twig", "/home/mliadov/public_html/application/modules/like_me/views/flatty/ajax_notify.twig");
    }
}
