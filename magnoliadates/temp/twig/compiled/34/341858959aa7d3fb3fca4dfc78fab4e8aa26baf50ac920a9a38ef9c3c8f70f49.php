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

/* view.twig */
class __TwigTemplate_12e500976fa241d5e7fc3f0c5bd9c01630005078f9259024c8741a2b4591ec06 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "view.twig", 1)->display($context);
        // line 2
        echo "<div class=\"news-content clearfix\">
        <div class=\"search-header\">
            <div class=\"title col-xs-12 col-sm-6 col-md-9 col-lg-9\">
                ";
        // line 5
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
        // line 6
        echo "            </div>
        </div>
        <div class=\"col-xs-12 col-sm-12 col-md-9 col-lg-9\">
            <div class=\"news news-item\">
                ";
        // line 10
        if ($this->getAttribute(($context["data"] ?? null), "img", [])) {
            // line 11
            echo "                    ";
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "media", []), "img", []), "thumbs", []), "big", [])) {
                // line 12
                echo "                        ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("text_news_photo"                ,"news"                ,""                ,"button"                ,($context["data"] ?? null)                ,                );
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
                // line 13
                echo "                        <img src=\"";
                echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "media", []), "img", []), "thumbs", []), "big", []);
                echo "\" align=\"left\" hspace=\"5\" vspace=\"5\" class=\"img-rounded\" alt=\"";
                echo ($context["text_news_photo"] ?? null);
                echo "\" title=\"";
                echo ($context["text_news_photo"] ?? null);
                echo "\" />
                    ";
            }
            // line 15
            echo "                ";
        }
        // line 16
        echo "                <span class=\"date\">
                    ";
        // line 17
        $module =         null;
        $helper =         'date_format';
        $name =         'tpl_date_format';
        $params = array($this->getAttribute(($context["data"] ?? null), "date_add", [])        ,$this->getAttribute(($context["date_format_st"] ?? null), "date_time_literal", [])        ,        );
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
        // line 18
        echo "                </span><br>

                ";
        // line 20
        if ( !$this->getAttribute(($context["data"] ?? null), "content", [])) {
            // line 21
            echo "                    <span class=\"annotation\">";
            echo $this->getAttribute(($context["data"] ?? null), "annotation", []);
            echo "</span><br>
                ";
        } else {
            // line 23
            echo "                    <span class=\"annotation\">";
            echo $this->getAttribute(($context["data"] ?? null), "content", []);
            echo "</span><br>
                ";
        }
        // line 25
        echo "                ";
        if ($this->getAttribute($this->getAttribute(($context["data"] ?? null), "video_content", []), "embed", [])) {
            // line 26
            echo "                    ";
            echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "video_content", []), "embed", []);
            echo "<br>
                ";
        }
        // line 28
        echo "                <div class=\"mt10 clearfix\">
                    <div class=\"links fleft\">
                        ";
        // line 30
        if ($this->getAttribute(($context["data"] ?? null), "feed_link", [])) {
            // line 31
            echo "                            ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("feed_source"            ,"news"            ,            );
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
            // line 32
            echo $this->getAttribute(($context["data"] ?? null), "feed_link", []);
            echo "\">";
            echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "feed", []), "title", []);
            echo "</a>
                        ";
        }
        // line 34
        echo "                    </div>
                </div>
            </div>
            ";
        // line 37
        $module =         null;
        $helper =         'banners';
        $name =         'show_banner_place';
        $params = array("banner-980x90"        ,        );
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
        // line 38
        echo "            <div class=\"show-comments-block\">
                ";
        // line 39
        $module =         null;
        $helper =         'comments';
        $name =         'comments_form';
        $params = array(["gid" => "news", "id_obj" => $this->getAttribute(        // line 41
($context["data"] ?? null), "id", []), "hidden" => 0, "count" => $this->getAttribute(        // line 43
($context["data"] ?? null), "comments_count", []), "view" => "button"]        ,        );
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
        // line 46
        echo "            </div>
            <div class=\"fleft mtb20\">
                <a href=\"";
        // line 48
        $module =         null;
        $helper =         'seo';
        $name =         'seolink';
        $params = array("news"        ,"index"        ,        );
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
                    ";
        // line 49
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_back_to_news"        ,"news"        ,        );
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
        // line 50
        echo "                </a>
            </div>
        </div>
        <div class=\"col-xs-12 col-sm-12 col-md-3 col-lg-3\">
                ";
        // line 54
        $module =         null;
        $helper =         'news';
        $name =         'newsRelated';
        $params = array(["count" => "10"]        ,        );
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
        echo "                <div class=\"mt10\">
                    ";
        // line 58
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
        // line 59
        echo "                    ";
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
        // line 60
        echo "                </div>
        </div>
</div>

";
        // line 64
        $module =         null;
        $helper =         'social_networking';
        $name =         'show_social_networks_like';
        $params = array(        );
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
        // line 65
        $module =         null;
        $helper =         'social_networking';
        $name =         'show_social_networks_share';
        $params = array(        );
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
        $module =         null;
        $helper =         'social_networking';
        $name =         'show_social_networks_comments';
        $params = array(        );
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
        // line 67
        echo "
<div class=\"clr\"></div>

";
        // line 70
        $this->loadTemplate("@app/footer.twig", "view.twig", 70)->display($context);
    }

    public function getTemplateName()
    {
        return "view.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  439 => 70,  434 => 67,  413 => 66,  392 => 65,  371 => 64,  365 => 60,  343 => 59,  322 => 58,  319 => 57,  298 => 54,  292 => 50,  271 => 49,  248 => 48,  244 => 46,  226 => 43,  225 => 41,  221 => 39,  218 => 38,  197 => 37,  192 => 34,  185 => 32,  161 => 31,  159 => 30,  155 => 28,  149 => 26,  146 => 25,  140 => 23,  134 => 21,  132 => 20,  128 => 18,  107 => 17,  104 => 16,  101 => 15,  91 => 13,  69 => 12,  66 => 11,  64 => 10,  58 => 6,  37 => 5,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "view.twig", "/home/mliadov/public_html/application/modules/news/views/flatty/view.twig");
    }
}
