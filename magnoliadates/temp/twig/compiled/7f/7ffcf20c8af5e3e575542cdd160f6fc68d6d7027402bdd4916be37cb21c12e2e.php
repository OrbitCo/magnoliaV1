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

/* list.twig */
class __TwigTemplate_211bf0be59342137e1d0d9020df88c1a2559caf3e840f17c7dfc673df2301841 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "list.twig", 1)->display($context);
        // line 2
        echo "
<div class=\"news-content clearfix\">
    <div class=\"search-header\">
        <div class=\"title col-xs-12 col-sm-6 col-md-9 col-lg-9\">
            ";
        // line 6
        $module =         null;
        $helper =         'seo';
        $name =         'seo_tags';
        $params = array("header_text"        ,        );
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
        echo "            <div class=\"fright\">
\t\t\t<a target=\"_blank\" class=\"fa fa-rss fa-lg edge hover zoom20\"
                   href=\"";
        // line 9
        echo ($context["site_url"] ?? null);
        echo "news/rss\"></a>
            </div>
        </div>
    </div>
    <div class=\"col-xs-12 col-sm-12 col-md-9 col-lg-9\">
        ";
        // line 14
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["news"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 15
            echo "            <div class=\"news news-item\">
                <div class=\"mb10\">
                    <a href=\"";
            // line 17
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("news"            ,"view"            ,$this->getAttribute(($context["item"] ?? null), "gid", [])            ,            );
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
            echo "\" class=\"strong-title\" title=\"";
            echo $this->getAttribute($context["item"], "name", []);
            echo "\">
                        ";
            // line 18
            echo $this->getAttribute($context["item"], "name", []);
            echo "
                    </a>
                    ";
            // line 20
            if ($this->getAttribute($context["item"], "img", [])) {
                // line 21
                echo "                        ";
                if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["item"], "media", []), "img", []), "thumbs", []), "small", [])) {
                    // line 22
                    echo "                            ";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("text_news_photo"                    ,"news"                    ,""                    ,"button"                    ,($context["item"] ?? null)                    ,                    );
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
                    $context['text_news_photo'] = $result;
                    // line 23
                    echo "                            <img src=\"";
                    echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["item"], "media", []), "img", []), "thumbs", []), "small", []);
                    echo "\" alt=\"";
                    echo ($context["text_news_logo"] ?? null);
                    echo "\" title=\"";
                    echo ($context["text_news_logo"] ?? null);
                    echo "\" alt=\"";
                    echo ($context["text_news_logo"] ?? null);
                    echo "\" class=\"img-rounded\" align=\"";
                    if (($this->getAttribute(($context["_LANG"] ?? null), "rtl", []) == "rtl")) {
                        echo "right";
                    } else {
                        echo "left";
                    }
                    echo "\" />
                        ";
                }
                // line 25
                echo "                    ";
            }
            // line 26
            echo "                </div>
                <div class=\"mb10\">
                    <span class=\"date\">
                            ";
            // line 29
            $module =             null;
            $helper =             'date_format';
            $name =             'tpl_date_format';
            $params = array($this->getAttribute(($context["item"] ?? null), "date_add", [])            ,$this->getAttribute(($context["date_format_st"] ?? null), "date_time_literal", [])            ,            );
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
            // line 30
            echo "                    </span>
                </div>
                <span class=\"annotation\">";
            // line 32
            echo $this->getAttribute($context["item"], "annotation", []);
            echo "</span>
                <div class=\"mt10 clearfix\">
                    <a href=\"";
            // line 34
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("news"            ,"view"            ,$this->getAttribute(($context["item"] ?? null), "gid", [])            ,            );
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
            echo "\" class=\"btn btn-primary-inverted\">
                        ";
            // line 35
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_view_more"            ,"news"            ,            );
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
            echo "                    </a>
                </div>
                <div class=\"mt10 clearfix\">
                    <div class=\"links fleft\">
                        ";
            // line 40
            if ($this->getAttribute($context["item"], "feed", [])) {
                // line 41
                echo "                            ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("feed_source"                ,"news"                ,                );
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
                echo ":
                            <a href=\"";
                // line 42
                echo $this->getAttribute($this->getAttribute($context["item"], "feed", []), "site_link", []);
                echo "\">";
                echo $this->getAttribute($this->getAttribute($context["item"], "feed", []), "title", []);
                echo "</a><br>
                        ";
            }
            // line 44
            echo "                    </div>
                    <div class=\"comments\">
                        <div class=\"comments-display-block\">
                            <a href=\"";
            // line 47
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("news"            ,"view"            ,$this->getAttribute(($context["item"] ?? null), "gid", [])            ,            );
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
                                <i class=\"far fa-comment\"></i>
                                <span class=\"counter\">";
            // line 49
            echo $this->getAttribute($context["item"], "comments_count", []);
            echo "</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class=\"clr\"></div>
            </div>
        ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 57
            echo "            <div class=\"empty\">
                ";
            // line 58
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("no_news_yet_header"            ,"news"            ,            );
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
            // line 59
            echo "            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 61
        echo "        <div class=\"clr\"></div>
        ";
        // line 62
        if (($context["news"] ?? null)) {
            // line 63
            echo "            <div class=\"line top\">
                ";
            // line 64
            $context["page_data"] = twig_array_merge(($context["page_data"] ?? null), ["type" => "full"]);
            // line 65
            echo "                ";
            $module =             null;
            $helper =             'start';
            $name =             'pagination';
            $params = array(($context["page_data"] ?? null)            ,            );
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
            // line 66
            echo "            </div>
        ";
        }
        // line 68
        echo "    </div>
    <div class=\"col-xs-12 col-sm-12 col-md-3 col-lg-3\">
        ";
        // line 70
        $module =         null;
        $helper =         'banners';
        $name =         'show_banner_place';
        $params = array("banner-320x250"        ,        );
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
        // line 71
        echo "        ";
        $module =         null;
        $helper =         'banners';
        $name =         'show_banner_place';
        $params = array("banner-320x75"        ,        );
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
        // line 72
        echo "    </div>
</div>
<div class=\"clr\"></div>

";
        // line 76
        $this->loadTemplate("@app/footer.twig", "list.twig", 76)->display($context);
    }

    public function getTemplateName()
    {
        return "list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  438 => 76,  432 => 72,  410 => 71,  389 => 70,  385 => 68,  381 => 66,  359 => 65,  357 => 64,  354 => 63,  352 => 62,  349 => 61,  342 => 59,  321 => 58,  318 => 57,  305 => 49,  281 => 47,  276 => 44,  269 => 42,  245 => 41,  243 => 40,  237 => 36,  216 => 35,  193 => 34,  188 => 32,  184 => 30,  163 => 29,  158 => 26,  155 => 25,  137 => 23,  115 => 22,  112 => 21,  110 => 20,  105 => 18,  80 => 17,  76 => 15,  71 => 14,  63 => 9,  59 => 7,  38 => 6,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "list.twig", "/home/mliadov/public_html/application/modules/news/views/flatty/list.twig");
    }
}
