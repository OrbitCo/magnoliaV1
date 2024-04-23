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

/* like_me_profiles.twig */
class __TwigTemplate_88efe9a088683f15c11310553713f669550bed52c8756cda4dce4d84adf8d3e3 extends \Twig\Template
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
        echo "<div class=\"b-likeme__mymatches\">
    <div class=\"g-flatty-block clearfix\">
        ";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["user_data"] ?? null), "content", []));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 4
            echo "            <div class=\"short-line\"></div>
            <div class=\"col-xs-6 col-sm-4 col-md-3 col-lg-3\">
                <div class=\"\">
                    <div class=\"g-users-gallery__content\">
                        <div class=\"g-users-gallery__photo\">
                            <a class=\"g-pic-border g-rounded\" href=\"";
            // line 9
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("users"            ,"view"            ,($context["item"] ?? null)            ,            );
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
                                <img class=\"img-responsive\" src=\"";
            // line 10
            echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["item"], "media", []), "user_logo", []), "thumbs", []), "great", []);
            echo "\" alt=\"\" />
                            </a>
                        </div>
                        <div class=\"g-users-gallery__info\">
                            <div class=\"text-overflow\">";
            // line 14
            $module =             null;
            $helper =             'users';
            $name =             'userName';
            $params = array(["format" => "age", "user" => ($context["item"] ?? null), "is_link" => 1]            ,            );
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
            echo "</div>
                                <div class=\"text-overflow\">
                                    ";
            // line 16
            if ($this->getAttribute($context["item"], "location", [])) {
                echo $this->getAttribute($context["item"], "location", []);
            } else {
                echo "&nbsp;";
            }
            // line 17
            echo "                                </div>

                        </div>
                    </div>
                </div>
            </div>
        ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 24
            echo "            <div>
                <h2>
                    ";
            // line 26
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("list_empty"            ,"like_me"            ,            );
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
            // line 27
            echo "                </h2>
                <div>
                    <input type=\"button\" id=\"go-perfect\" value=\"";
            // line 29
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_play_more_perfect"            ,"like_me"            ,            );
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
            echo "\" class=\"btn btn-secondary\">
                </div>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 33
        echo "        
    </div>
    ";
        // line 35
        if ( !twig_test_empty($this->getAttribute(($context["user_data"] ?? null), "have_more", []))) {
            // line 36
            echo "        <div class=\"match-button-content\">
            <input id=\"show_more\"  data-type=\"";
            // line 37
            echo $this->getAttribute(($context["data"] ?? null), "type", []);
            echo "\" type=\"button\" value=\"";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("button_show_more"            ,"like_me"            ,            );
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
            echo "\" class=\"btn btn-cancel form-control\">
        </div>
    ";
        }
        // line 40
        echo "    <script>
        \$('.b-likeme-page').css({'position': 'relative', 'top': '2px'});
    </script>";
    }

    public function getTemplateName()
    {
        return "like_me_profiles.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  211 => 40,  184 => 37,  181 => 36,  179 => 35,  175 => 33,  146 => 29,  142 => 27,  121 => 26,  117 => 24,  106 => 17,  100 => 16,  76 => 14,  69 => 10,  46 => 9,  39 => 4,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "like_me_profiles.twig", "/home/mliadov/public_html/application/modules/like_me/views/flatty/like_me_profiles.twig");
    }
}
