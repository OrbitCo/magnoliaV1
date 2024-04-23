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

/* wall_events.twig */
class __TwigTemplate_f7fb8466465e275f84b6abedc6dffe107a65b26c4f5470047752009abdcc84b2 extends \Twig\Template
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
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["events"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["e"]) {
            // line 2
            echo "\t";
            if ($this->getAttribute($context["e"], "html", [])) {
                // line 3
                echo "\t\t";
                $context["e_user_id"] = $this->getAttribute($context["e"], "id_poster", []);
                // line 4
                echo "\t\t";
                if ($this->getAttribute(($context["users"] ?? null), ($context["e_user_id"] ?? null), [], "array")) {
                    // line 5
                    echo "\t\t\t";
                    $context["e_user"] = $this->getAttribute(($context["users"] ?? null), ($context["e_user_id"] ?? null), [], "array");
                    // line 6
                    echo "\t\t";
                } else {
                    // line 7
                    echo "\t\t\t";
                    $context["e_user"] = $this->getAttribute(($context["users"] ?? null), 0, [], "array");
                    // line 8
                    echo "\t\t";
                }
                // line 9
                echo "        <div class=\"media b-media-wallpost\" id=\"wall_event_";
                echo $this->getAttribute($context["e"], "id", []);
                echo "\" gid=\"";
                echo $this->getAttribute($context["e"], "event_type_gid", []);
                echo "\">
            <div class=\"media-left\">
                ";
                // line 11
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("text_wall_photo"                ,"wall"                ,""                ,"button"                ,($context["e"] ?? null)                ,                );
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
                $context['text_wall_photo'] = $result;
                // line 12
                echo "                <a class=\"g-pic-border g-rounded\" href=\"";
                ob_start(function () { return ''; });
                // line 13
                echo "                        ";
                if ( !twig_test_empty($this->getAttribute(($context["e_user"] ?? null), "id", []))) {
                    // line 14
                    echo "                            ";
                    $module =                     null;
                    $helper =                     'seo';
                    $name =                     'seolink';
                    $params = array("users"                    ,"view"                    ,($context["e_user"] ?? null)                    ,                    );
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
                    echo "                        ";
                } else {
                    // line 16
                    echo "                            ";
                    $module =                     null;
                    $helper =                     'seo';
                    $name =                     'seolink';
                    $params = array("users"                    ,"untitled"                    ,                    );
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
                    // line 17
                    echo "                        ";
                }
                // line 18
                echo "                    ";
                echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
                echo "\">
                    ";
                // line 19
                $module =                 null;
                $helper =                 'users';
                $name =                 'formatAvatar';
                $params = array(["user" => ($context["e_user"] ?? null), "size" => "small", "id" => ((("avatar_" . $this->getAttribute(($context["e_user"] ?? null), "id", [])) . "_e_") . $this->getAttribute(($context["e"] ?? null), "id", []))]                ,                );
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
                // line 20
                echo "                </a>
            </div>
            <div class=\"media-body\">
                <span class=\"b-media-wallpost__heading\">
                    <a href=\"";
                // line 24
                ob_start(function () { return ''; });
                // line 25
                echo "                            ";
                if ( !twig_test_empty($this->getAttribute(($context["e_user"] ?? null), "id", []))) {
                    // line 26
                    echo "                                ";
                    $module =                     null;
                    $helper =                     'seo';
                    $name =                     'seolink';
                    $params = array("users"                    ,"view"                    ,($context["e_user"] ?? null)                    ,                    );
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
                    echo "                            ";
                } else {
                    // line 28
                    echo "                                ";
                    $module =                     null;
                    $helper =                     'seo';
                    $name =                     'seolink';
                    $params = array("users"                    ,"untitled"                    ,                    );
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
                    // line 29
                    echo "                            ";
                }
                // line 30
                echo "                        ";
                echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
                echo "\">
                        ";
                // line 31
                echo $this->getAttribute(($context["e_user"] ?? null), "output_name", []);
                echo "
                    </a>
                </span>

                ";
                // line 35
                echo $this->getAttribute($context["e"], "html", []);
                echo "

                <div class=\"b-media-wallpost__footer\">
                    <span onclick=\"";
                // line 38
                $module =                 null;
                $helper =                 'start';
                $name =                 'setAnalytics';
                $params = array("home_wall"                ,"like"                ,                );
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
                echo "\" class=\"fright\">
                        ";
                // line 39
                $module =                 null;
                $helper =                 'likes';
                $name =                 'like_block';
                $params = array(["gid" => ("wevt" . $this->getAttribute(                // line 40
($context["e"] ?? null), "id", [])), "type" => "button"]                ,                );
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
                // line 43
                echo "                    </span>
                    <span>
                        ";
                // line 45
                $module =                 null;
                $helper =                 'comments';
                $name =                 'comments_form';
                $params = array(["gid" => "wall_events", "id_obj" => $this->getAttribute(                // line 47
($context["e"] ?? null), "id", []), "hidden" => 1, "count" => $this->getAttribute(                // line 49
($context["e"] ?? null), "comments_count", []), "view" => "icon"]                ,                );
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
                // line 52
                echo "                    </span>
                </div>
            </div>
        </div>

\t";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['e'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "wall_events.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  317 => 52,  299 => 49,  298 => 47,  294 => 45,  290 => 43,  272 => 40,  268 => 39,  245 => 38,  239 => 35,  232 => 31,  227 => 30,  224 => 29,  202 => 28,  199 => 27,  177 => 26,  174 => 25,  172 => 24,  166 => 20,  145 => 19,  140 => 18,  137 => 17,  115 => 16,  112 => 15,  90 => 14,  87 => 13,  84 => 12,  63 => 11,  55 => 9,  52 => 8,  49 => 7,  46 => 6,  43 => 5,  40 => 4,  37 => 3,  34 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "wall_events.twig", "/home/mliadov/public_html/application/modules/wall_events/views/flatty/wall_events.twig");
    }
}
