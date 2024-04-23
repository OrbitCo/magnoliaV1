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
class __TwigTemplate_7ef9482536baaa624d430aca49ac749e6bc73a322be536ac933c76bbdc9d5fde extends \Twig\Template
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
<!--Profile -->\t\t\t\t\t
<div class=\"col-xs-12 col-sm-3 col-md-3 col-lg-3\">\t
    <div class=\"hide-in-mobile\">
        ";
        // line 6
        $module =         null;
        $helper =         'users';
        $name =         'get_preview';
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
        // line 7
        echo "        ";
        $module =         null;
        $helper =         'banners';
        $name =         'show_banner_place';
        $params = array("banner-185x75"        ,        );
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
        // line 8
        echo "        ";
        $module =         null;
        $helper =         'media';
        $name =         'user_media_block';
        $params = array(["count" => 9, "user_id" => ($context["user_id"] ?? null)]        ,        );
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
        echo "   
        ";
        // line 9
        $module =         null;
        $helper =         'banners';
        $name =         'show_banner_place';
        $params = array("banner-185x155"        ,        );
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
        // line 10
        echo "    </div>
</div>
<!--Profile -->

<div class=\"col-xs-12 col-sm-9 col-md-9 col-lg-9\">
    <h1>
        ";
        // line 16
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
        // line 17
        echo "    </h1>
    <div class=\"search-type-page clearfix\">
        ";
        // line 19
        if (($context["count"] ?? null)) {
            // line 20
            echo "            <div class=\"stp-menu-block clearfix\">
                <div class=\"stp-menu-inner\">

                </div>
                <div class=\"sub-search-form col-xs-12 mt10\">
                    <form method=\"post\" action=\"\" class=\"form-inline\">
                        <div class=\"form-group\">
                            <input type=\"text\" class=\"form-control fleft\" name=\"search\" value=\"";
            // line 27
            echo twig_escape_filter($this->env, ($context["search"] ?? null));
            echo "\" placeholder=\"";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("search"            ,"blacklist"            ,""            ,"button"            ,            );
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
            echo "\" />&nbsp;
                            <input type=\"submit\" value=\"";
            // line 28
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_search"            ,"start"            ,            );
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
            echo "\" class=\"btn btn-primary fright\" />
                        </div>
                    </form>
                </div>
            </div>
        ";
        }
        // line 34
        echo "        <div class=\"stp-content-block clearfix\">
            ";
        // line 35
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["list"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 36
            echo "                <div id=\"block_user_";
            echo $this->getAttribute($this->getAttribute($context["item"], "user", []), "id", []);
            echo "\" class=\"item col-xs-6 col-sm-4 col-md-3 col-lg-3\">
                    <div class=\"user\">
                        <div class=\"photo\">
                            <a class=\"g-pic-border g-rounded\" href=\"";
            // line 39
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("users"            ,"view"            ,$this->getAttribute(($context["item"] ?? null), "user", [])            ,            );
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
            // line 40
            $module =             null;
            $helper =             'users';
            $name =             'formatAvatar';
            $params = array(["user" => $this->getAttribute(($context["item"] ?? null), "user", []), "size" => "great"]            ,            );
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
            echo "                            </a>
                            <div class=\"actions\">
                                <div class=\"text-overflow\">
                                    ";
            // line 44
            if ($this->getAttribute($this->getAttribute($context["item"], "user", []), "id", [])) {
                // line 45
                echo "                                        <a id=\"blacklist_remove_";
                echo $this->getAttribute($this->getAttribute($context["item"], "user", []), "id", []);
                echo "\" data-pjax=\"0\" data-toggle=\"tooltip\" data-placement=\"left\"
                                           data-userid=\"";
                // line 46
                echo $this->getAttribute($this->getAttribute($context["item"], "user", []), "id", []);
                echo "\" href=\"";
                echo ($context["site_url"] ?? null);
                echo "blacklist/remove/";
                echo $this->getAttribute($this->getAttribute($context["item"], "user", []), "id", []);
                echo "\"
                                           class=\"remove_from_blacklist btn-link link-r-margin\" title=\"";
                // line 47
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("action_remove"                ,"blacklist"                ,""                ,"button"                ,                );
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
                                    ";
            }
            // line 51
            echo "                                </div>
                            </div>
                        </div>
                        <div class=\"info\">
                            <div class=\"text-overflow\">
                                <a href=\"";
            // line 56
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("users"            ,"view"            ,$this->getAttribute(($context["item"] ?? null), "user", [])            ,            );
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
            // line 57
            echo $this->getAttribute($this->getAttribute($context["item"], "user", []), "output_name", []);
            echo "
                                </a>, ";
            // line 58
            echo $this->getAttribute($this->getAttribute($context["item"], "user", []), "age", []);
            echo "
                            </div>
                            ";
            // line 60
            if ($this->getAttribute($this->getAttribute($context["item"], "user", []), "location", [])) {
                // line 61
                echo "                                <div class=\"text-overflow\">
                                    ";
                // line 62
                echo $this->getAttribute($this->getAttribute($context["item"], "user", []), "location", []);
                echo "
                                </div>
                            ";
            }
            // line 65
            echo "                            <div class=\"text-overflow\">
                                ";
            // line 66
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
            // line 67
            echo "                            </div>
                        </div>
                    </div>
                </div>
            ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 72
            echo "                <div class=\"empty text-center p10\">
                    ";
            // line 73
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("empty_result"            ,"blacklist"            ,            );
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
            // line 74
            echo "                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 76
        echo "        </div>
        ";
        // line 77
        if (($context["list"] ?? null)) {
            // line 78
            echo "            <div id=\"pages_block_2\" class=\"tac\">
                ";
            // line 79
            $context["page_data"] = twig_array_merge(($context["page_data"] ?? null), ["type" => "full"]);
            // line 80
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
            // line 81
            echo "            </div>
        ";
        }
        // line 83
        echo "    </div>
</div>
<script type=\"text/javascript\">
    \$(function(){
        \$('.stp-content-block .actions a').tooltip();
    })
</script>
";
        // line 90
        $this->loadTemplate("@app/footer.twig", "list.twig", 90)->display($context);
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
        return array (  487 => 90,  478 => 83,  474 => 81,  452 => 80,  450 => 79,  447 => 78,  445 => 77,  442 => 76,  435 => 74,  414 => 73,  411 => 72,  402 => 67,  381 => 66,  378 => 65,  372 => 62,  369 => 61,  367 => 60,  362 => 58,  358 => 57,  335 => 56,  328 => 51,  302 => 47,  294 => 46,  289 => 45,  287 => 44,  282 => 41,  261 => 40,  238 => 39,  231 => 36,  226 => 35,  223 => 34,  195 => 28,  170 => 27,  161 => 20,  159 => 19,  155 => 17,  134 => 16,  126 => 10,  105 => 9,  81 => 8,  59 => 7,  38 => 6,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "list.twig", "/home/mliadov/public_html/application/modules/blacklist/views/flatty/list.twig");
    }
}
