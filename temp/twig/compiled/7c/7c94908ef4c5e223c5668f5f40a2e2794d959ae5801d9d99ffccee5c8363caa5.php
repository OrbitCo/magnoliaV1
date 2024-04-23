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

/* helper_play.twig */
class __TwigTemplate_f132ab320555fcaf3721a4e2ec1b2ba9838ed8d08f61b8142b064e10948ee410 extends \Twig\Template
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
        if ( !twig_test_empty(($context["user_data"] ?? null))) {
            // line 2
            echo "    <div class=\"b-likeme__media\" data-profile_id=\"";
            echo $this->getAttribute(($context["user_data"] ?? null), "id", []);
            echo "\">
        <div class=\"b-likeme__image\">
            <div id=\"user_photo_bg\" class=\"magazine-profile__avabg\" style=\"background: url(";
            // line 4
            echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["user_data"] ?? null), "media", []), "user_logo", []), "thumbs", []), "grand", []);
            echo ") no-repeat center / cover;\"></div>
            <div id=\"congratulations\" class=\"center\"></div>
            <div class=\"b-likeme_h100 pos-rel\">
                <img src=\"";
            // line 7
            echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["user_data"] ?? null), "media", []), "user_logo", []), "thumbs", []), "grand", []);
            echo "\"
                     alt=\"";
            // line 8
            echo $this->getAttribute(($context["user_data"] ?? null), "output_name", []);
            echo "\"
                     title=\"";
            // line 9
            echo $this->getAttribute(($context["user_data"] ?? null), "output_name", []);
            echo "\" class=\"img-responsive\" />

                <div class=\"b-likeme__name\">
                    <a href=\"";
            // line 12
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("users"            ,"view"            ,($context["user_data"] ?? null)            ,            );
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
            echo "\" class=\"like_me-name\">";
            echo $this->getAttribute(($context["user_data"] ?? null), "output_name", []);
            echo "</a>,<span class=\"like_me-age\">&nbsp;";
            echo $this->getAttribute(($context["user_data"] ?? null), "age", []);
            echo "</span>
                </div>
            </div>
        </div>

        <div id=\"action-button\" class=\"b-likeme__actions\">
            <div class=\"row\">
                <div class=\"col-md-12\">
                    <div class=\"col-xs-6\">
                        <a id=\"skip_button\" href=\"javascript:void(0);\" class=\"btn btn-secondary btn-lg\">
                            <span class=\"fas fa-long-arrow-alt-right\"></span>
                            ";
            // line 23
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("button_skip"            ,"like_me"            ,            );
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
            // line 24
            echo "                        </a>
                    </div>
                    <div class=\"col-xs-6\">
                        <a id=\"like_button\" href=\"javascript:void(0);\" class=\"btn persistent-like_button btn-lg\"
                           data-action=\"like\">
                            <i class=\"fa fa-heart\"></i>
                            ";
            // line 30
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("button_like"            ,"like_me"            ,            );
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
            // line 31
            echo "                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
";
        } else {
            // line 38
            echo "    <div class=\"b-likeme__null\">
        <h2>
            ";
            // line 40
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("empty_users_list"            ,"like_me"            ,            );
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
            // line 41
            echo "        </h2>
        <div>
            ";
            // line 43
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["play_more"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 44
                echo "                ";
                $context["field"] = ("field_play_more_" . $context["key"]);
                // line 45
                echo "                <input type=\"button\" id=\"go-";
                echo $context["key"];
                echo "\" value=\"";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array(($context["field"] ?? null)                ,"like_me"                ,                );
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
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 47
            echo "        </div>
    </div>
";
        }
    }

    public function getTemplateName()
    {
        return "helper_play.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  220 => 47,  190 => 45,  187 => 44,  183 => 43,  179 => 41,  158 => 40,  154 => 38,  145 => 31,  124 => 30,  116 => 24,  95 => 23,  58 => 12,  52 => 9,  48 => 8,  44 => 7,  38 => 4,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_play.twig", "/home/mliadov/public_html/application/modules/like_me/views/flatty/helper_play.twig");
    }
}
