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
class __TwigTemplate_44324a2aff31a60b73454280152823335915f31dcbd96cee2cbe5b0d62c36005 extends \Twig\Template
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
        $module =         null;
        $helper =         'like_me';
        $name =         'isLiked';
        $params = array(["profile_id" => ($context["profile_id"] ?? null)]        ,        );
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
        $context['is_liked'] = $result;
        // line 2
        $module =         null;
        $helper =         'blacklist';
        $name =         'in_my_blacklist';
        $params = array(($context["profile_id"] ?? null)        ,        );
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
        $context['in_blacklist'] = $result;
        // line 3
        echo "
<div class=\"magazine-profile__likemepanel likemecontrols ";
        // line 4
        if (($context["in_blacklist"] ?? null)) {
            echo " hide ";
        }
        echo "\">
    <a href='";
        // line 5
        if (twig_test_empty($this->getAttribute(($context["flipping_navigation"] ?? null), "prev", []))) {
            echo "javascript:;";
        } else {
            echo $this->getAttribute(($context["flipping_navigation"] ?? null), "prev", []);
        }
        echo "'  
       class=\"likemecontrols__item likemecontrols__item_back ";
        // line 6
        if (twig_test_empty($this->getAttribute(($context["flipping_navigation"] ?? null), "prev", []))) {
            echo "inactive";
        }
        echo "\">
        <span class=\"fa fa-undo\"></span>
    </a>
    <a href='";
        // line 9
        if (twig_test_empty($this->getAttribute(($context["flipping_navigation"] ?? null), "next", []))) {
            echo "javascript:;";
        } else {
            echo $this->getAttribute(($context["flipping_navigation"] ?? null), "next", []);
        }
        echo "'  
       class=\"likemecontrols__item likemecontrols__item_skip ";
        // line 10
        if (twig_test_empty($this->getAttribute(($context["flipping_navigation"] ?? null), "next", []))) {
            echo "inactive";
        }
        echo "\">
        <span class=\"fa fa-times\"></span>&nbsp;";
        // line 11
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("button_skip"        ,"like_me"        ,        );
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
        // line 12
        echo "    </a>
    <button  data-pjax=\"0\" id=\"like_button\" class=\"likemecontrols__item ";
        // line 13
        if ((($context["is_liked"] ?? null) == false)) {
            echo "likemecontrols__item_like";
        } else {
            echo "likemecontrols__item_liked";
        }
        echo "\" data-action=\"";
        if ((($context["is_liked"] ?? null) == false)) {
            echo "like";
        } else {
            echo "unlike";
        }
        echo "\">
        <span class=\"";
        // line 14
        if ((($context["is_liked"] ?? null) == false)) {
            echo "far fa-heart ";
        } else {
            echo "fas fa-heart\"";
        }
        echo "\"></span>&nbsp;";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("button_like"        ,"like_me"        ,        );
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
        // line 15
        echo "    </button>
</div>
<script>
    \$(function () {
        loadScripts(
                [
                    \"";
        // line 21
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("like_me"        ,"like_me.js"        ,"path"        ,        );
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
        echo "\",
                    \"";
        // line 22
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("like_me"        ,"match_me.js"        ,"path"        ,        );
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
                ],
                function () {
                    like_me = new LikeMe({
                        siteUrl: site_url,
                        action_id: 'play_global',
                        isRegistr: 0,
                        isFlippingProfiles: 1,
                        langs: {
                            header: \"";
        // line 31
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_evaluate_users"        ,"like_me"        ,        );
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
        echo "\",
                            gotItBtn: \"";
        // line 32
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_got_it"        ,"like_me"        ,        );
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
        echo "\",
                            searchBtn: \"";
        // line 33
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_skip"        ,"like_me"        ,        );
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
                        }
                    });
                    match_me = new MatchMe({
                        siteUrl: site_url,
                        all_loaded: 0,
                        show_more_lang: \"";
        // line 39
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("button_show_more"        ,"like_me"        ,        );
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
        echo "\",
                    });
                },
                ['like_me', 'match_me'],
                {async: true}
        );

        \$(\"[data-mobile-pop]\").on(\"click\", function () {
            var mob_pop = \$(this).attr(\"data-mobile-pop\");
            \$(mob_pop).addClass(\"b-mobile-pop_show\");
        });
        \$(\"[data-mobile-pop-close]\").on(\"click\", function () {
            \$(this).parents('.b-mobile-pop').removeClass('b-mobile-pop_show');
        });
    });
</script>";
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
        return array (  312 => 39,  284 => 33,  261 => 32,  238 => 31,  207 => 22,  184 => 21,  176 => 15,  149 => 14,  135 => 13,  132 => 12,  111 => 11,  105 => 10,  97 => 9,  89 => 6,  81 => 5,  75 => 4,  72 => 3,  51 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_flipping_profiles.twig", "/home/mliadov/public_html/application/modules/like_me/views/flatty/helper_flipping_profiles.twig");
    }
}
