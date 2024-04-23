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

/* like_me_matches.twig */
class __TwigTemplate_8d6a6d6bf198b564251fb84c6e75c0b9c71f7f8b8fb29ca7b57190089aa466dc extends \Twig\Template
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
                            <div class=\"g-users-gallery__actions\">
                                <div class=\"g-photo-actions\">
                                    <a href=\"";
            // line 14
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("like_me"            ,"remove"            ,["profile_id" => $this->getAttribute(($context["item"] ?? null), "id", [])]            ,            );
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
            echo "\"
                                       title=\"";
            // line 15
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_action_remove"            ,"like_me"            ,            );
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
                                        <i class=\"fa fa-times\"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class=\"g-users-gallery__info\">
                            <div class=\"text-overflow\">";
            // line 22
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
                            ";
            // line 23
            if ($this->getAttribute($context["item"], "location", [])) {
                // line 24
                echo "                                <div class=\"text-overflow\">
                                    ";
                // line 25
                echo $this->getAttribute($context["item"], "location", []);
                echo "
                                </div>
                            ";
            }
            // line 28
            echo "                            <div>
                                ";
            // line 29
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["settings"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["set"]) {
                // line 30
                echo "                                    ";
                if ( !twig_test_empty($this->getAttribute($context["set"], "helper", []))) {
                    // line 31
                    echo "                                        ";
                    $module =                     null;
                    $helper = $context["key"];
                    $name = $this->getAttribute($context["set"], "helper", []);
                    $params = array(["id_user" => $this->getAttribute(                    // line 32
($context["item"] ?? null), "id", []), "user_id" => $this->getAttribute(                    // line 33
($context["item"] ?? null), "id", []), "id_contact" => $this->getAttribute(                    // line 34
($context["item"] ?? null), "id", []), "new_tab" => 1]                    ,                    );
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
                    // line 37
                    echo "                                    ";
                }
                // line 38
                echo "                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['set'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 39
            echo "                            </div>
                        </div>
                    </div>
                </div>
            </div>
        ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 45
            echo "            <div>
                <h2>
                    ";
            // line 47
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("empty_list"            ,"like_me"            ,            );
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
            // line 48
            echo "                </h2>
                <div>
                    <input type=\"button\" id=\"go-perfect\" value=\"";
            // line 50
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
        // line 54
        echo "        ";
        if ( !twig_test_empty($this->getAttribute(($context["user_data"] ?? null), "have_more", []))) {
            // line 55
            echo "            <div class=\"match-button-content\">
                <input id=\"show_more\" data-type=\"";
            // line 56
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
        // line 59
        echo "    </div>
<script>
    \$('.b-likeme-page').css({'position': 'relative', 'top': '2px'});
</script>";
    }

    public function getTemplateName()
    {
        return "like_me_matches.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  307 => 59,  280 => 56,  277 => 55,  274 => 54,  245 => 50,  241 => 48,  220 => 47,  216 => 45,  206 => 39,  200 => 38,  197 => 37,  179 => 34,  178 => 33,  177 => 32,  172 => 31,  169 => 30,  165 => 29,  162 => 28,  156 => 25,  153 => 24,  151 => 23,  128 => 22,  99 => 15,  76 => 14,  69 => 10,  46 => 9,  39 => 4,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "like_me_matches.twig", "/home/mliadov/public_html/application/modules/like_me/views/flatty/like_me_matches.twig");
    }
}
