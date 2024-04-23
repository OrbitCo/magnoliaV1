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

/* comments_block.twig */
class __TwigTemplate_e1b64b880a6b9c3f462b82fe42d844e5245b14e0bbe3b32d866c36ecb169bbe2 extends \Twig\Template
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
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["comments"] ?? null), "comments", []));
        foreach ($context['_seq'] as $context["_key"] => $context["comment"]) {
            // line 2
            echo "    ";
            if (($this->getAttribute($context["comment"], "status", []) == 1)) {
                // line 3
                echo "        ";
                $context["comment_id_user"] = $this->getAttribute($context["comment"], "id_user", []);
                // line 4
                echo "        ";
                $context["comment_user"] = $this->getAttribute($this->getAttribute(($context["comments"] ?? null), "users", []), ($context["comment_id_user"] ?? null));
                // line 5
                echo "        <div id=\"comment_id_";
                echo $this->getAttribute($context["comment"], "id", []);
                echo "\" class=\"comment_block item b user-content\">
            <div class=\"image\">
                ";
                // line 7
                ob_start(function () { return ''; });
                // line 8
                echo "                    ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("text_user_logo"                ,"comments"                ,""                ,"button"                ,($context["data"] ?? null)                ,                );
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
                // line 9
                echo "                ";
                $context["text_user_logo"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
                // line 10
                echo "                ";
                if ( !$this->getAttribute(($context["comment_user"] ?? null), "is_guest", [])) {
                    // line 11
                    echo "                    <a data-action=\"set_user_ids\" data-gid=\"comments\" class=\"g-pic-border g-rounded-small\" data-href=\"";
                    $module =                     null;
                    $helper =                     'seo';
                    $name =                     'seolink';
                    $params = array("users"                    ,"view"                    ,($context["comment_user"] ?? null)                    ,                    );
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
                    echo "\" href=\"#\">
                        <img class=\"wall-comment-block-img\" src=\"";
                    // line 12
                    echo $this->getAttribute(($context["comment_user"] ?? null), "user_logo", []);
                    echo "\" alt=\"";
                    echo ($context["text_user_logo"] ?? null);
                    echo "\" title=\"";
                    echo ($context["text_user_logo"] ?? null);
                    echo "\" />
                    </a>
                ";
                } else {
                    // line 15
                    echo "                    <span class=\"g-pic-border g-rounded-small\">
                        <img class=\"wall-comment-block-img\" src=\"";
                    // line 16
                    echo $this->getAttribute(($context["comment_user"] ?? null), "user_logo", []);
                    echo "\" alt=\"";
                    echo ($context["text_user_logo"] ?? null);
                    echo "\" title=\"";
                    echo ($context["text_user_logo"] ?? null);
                    echo "\" />
                    </span>
                ";
                }
                // line 19
                echo "            </div>
            <div class=\"content\">
                <div class=\"comment-entry\">
                    <span class=\"comment-heading\">
                        ";
                // line 23
                if (($this->getAttribute(($context["comment_user"] ?? null), "is_guest", []) && $this->getAttribute($context["comment"], "user_name", []))) {
                    // line 24
                    echo "                            ";
                    echo $this->getAttribute($context["comment"], "user_name", []);
                    echo "
                        ";
                } else {
                    // line 26
                    echo "                            <a data-action=\"set_user_ids\" data-gid=\"comments\" data-href=\"";
                    $module =                     null;
                    $helper =                     'seo';
                    $name =                     'seolink';
                    $params = array("users"                    ,"view"                    ,($context["comment_user"] ?? null)                    ,                    );
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
                    echo "\" href=\"#\">
                                ";
                    // line 27
                    echo $this->getAttribute(($context["comment_user"] ?? null), "output_name", []);
                    echo "
                            </a>
                        ";
                }
                // line 30
                echo "                    </span>
                    <span class=\"comment-date\">
                        ";
                // line 32
                $module =                 null;
                $helper =                 'date_format';
                $name =                 'tpl_date_format';
                $params = array($this->getAttribute(($context["comment"] ?? null), "date", [])                ,$this->getAttribute(($context["date_format_st"] ?? null), "date_time_literal", [])                ,                );
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
                // line 33
                echo "                    </span>

                    ";
                // line 35
                if ( !$this->getAttribute($context["comment"], "is_author", [])) {
                    // line 36
                    echo "                        <span onclick=\"";
                    $module =                     null;
                    $helper =                     'start';
                    $name =                     'setAnalytics';
                    $params = array("home_wall"                    ,"comment_report"                    ,                    );
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
                    echo "\" class=\"ml10\">
                            ";
                    // line 37
                    $module =                     null;
                    $helper =                     'spam';
                    $name =                     'mark_as_spam_block';
                    $params = array(["object_id" => $this->getAttribute(                    // line 38
($context["comment"] ?? null), "id", []), "type_gid" => "comments_object", "template" => "minibutton"]                    ,                    );
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
                    // line 42
                    echo "                        </span>
                    ";
                }
                // line 44
                echo "                <div class=\"comment-content\">
                    ";
                // line 45
                echo nl2br(twig_escape_filter($this->env, $this->getAttribute($context["comment"], "text", []), "html", null, true));
                echo "
                </div>
                <div class=\"comment-btns-line\">
                    <span>
                        ";
                // line 49
                if ($this->getAttribute($this->getAttribute(($context["comments_type"] ?? null), "settings", []), "use_likes", [])) {
                    // line 50
                    echo "                            <span onclick=\"";
                    $module =                     null;
                    $helper =                     'start';
                    $name =                     'setAnalytics';
                    $params = array("home_wall"                    ,"like"                    ,                    );
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
                    // line 51
                    $module =                     null;
                    $helper =                     'likes';
                    $name =                     'like_block';
                    $params = array(["gid" => ("cmnt" . $this->getAttribute(($context["comment"] ?? null), "id", [])), "type" => "button"]                    ,                    );
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
                    echo "                            </span>
                        ";
                }
                // line 54
                echo "                        ";
                if ($this->getAttribute($context["comment"], "can_edit", [])) {
                    // line 55
                    echo "                            <a href=\"javascript:;\" onclick=\"comments.deleteComment('";
                    echo $this->getAttribute($context["comment"], "id", []);
                    echo "'); event.preventDefault();\">
                               ";
                    // line 56
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("btn_delete"                    ,"start"                    ,                    );
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
                    // line 57
                    echo "                            </a>
                        ";
                }
                // line 59
                echo "                    </span>
                </div>
            </div>
        </div>
        </div>
    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['comment'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "comments_block.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  345 => 59,  341 => 57,  320 => 56,  315 => 55,  312 => 54,  308 => 52,  287 => 51,  263 => 50,  261 => 49,  254 => 45,  251 => 44,  247 => 42,  229 => 38,  225 => 37,  201 => 36,  199 => 35,  195 => 33,  174 => 32,  170 => 30,  164 => 27,  140 => 26,  134 => 24,  132 => 23,  126 => 19,  116 => 16,  113 => 15,  103 => 12,  79 => 11,  76 => 10,  73 => 9,  51 => 8,  49 => 7,  43 => 5,  40 => 4,  37 => 3,  34 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "comments_block.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\comments\\views\\flatty\\comments_block.twig");
    }
}
