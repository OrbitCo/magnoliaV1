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
class __TwigTemplate_d0e47f3aca85e8fa62fcb264a8124fd73a1a12ae9c583c20c059529cc6ace361 extends \Twig\Template
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
        echo "<div class=\"col-xs-12\">
    <h1>
        ";
        // line 4
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
        // line 5
        echo "    </h1>
</div>
<!--Profile -->
<div class=\"col-xs-12 col-sm-3 col-md-3 col-lg-3\">
    <div class=\"hide-in-mobile\">
        ";
        // line 10
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
        // line 11
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
        // line 12
        echo "    </div>
</div>
<!--Profile -->
<div class=\"col-xs-12 col-sm-9 col-md-9 col-lg-9\">
    <div class=\"g-flatty-block\">
        <div class=\"b-tabs b-tabs_wrapper\">
            <div class=\"b-tabs__item ";
        // line 18
        if ((($context["tab"] ?? null) == "my_favs")) {
            echo "active";
        }
        echo "\">
                <a class=\"b-tabs__text\" data-pjax-no-scroll=\"1\" href=\"";
        // line 19
        $module =         null;
        $helper =         'seo';
        $name =         'seolink';
        $params = array("favorites"        ,"my_favs"        ,        );
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
        // line 20
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("my_fav"        ,"favorites"        ,        );
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
        // line 21
        echo "                </a>
            </div>
            <div class=\"b-tabs__item ";
        // line 23
        if ((($context["tab"] ?? null) != "my_favs")) {
            echo "active";
        }
        echo "\" id=\"inbox\">
                <a class=\"b-tabs__text\" data-pjax-no-scroll=\"1\" href=\"";
        // line 24
        $module =         null;
        $helper =         'seo';
        $name =         'seolink';
        $params = array("favorites"        ,"i_am_their_fav"        ,        );
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
        // line 25
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("fav_me"        ,"favorites"        ,        );
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
        // line 26
        echo "                </a>
            </div>
        </div>
        ";
        // line 29
        if (($context["count"] ?? null)) {
            // line 30
            echo "            <div class=\"g-flatty-block__control\">
                <form method=\"post\" action=\"\" class=\"form-inline\">
                  <div class=\"col-xs-12\">
                    <div class=\"form-group\">
                        <input type=\"text\" placeholder=\"";
            // line 34
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("search"            ,"favorites"            ,            );
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
            echo "\" name=\"search\" value=\"";
            echo twig_escape_filter($this->env, ($context["search"] ?? null));
            echo "\" class=\"form-control\" />
                    </div>
                    <input type=\"submit\" value=\"";
            // line 36
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
            echo "\" class=\"btn btn-primary\" />
                  </div>
                  <div class=\"clearfix\"></div>
                </form>
            </div>
        ";
        }
        // line 42
        echo "
        <div class=\"row g-users-gallery ";
        // line 43
        if ((($context["tab"] ?? null) == "my_favs")) {
            echo "w-actions";
        }
        echo "\">
            ";
        // line 44
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["list"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 45
            echo "                <div id=\"fav_";
            echo $this->getAttribute($this->getAttribute($context["item"], "user", []), "id", []);
            echo "\" class=\"g-users-gallery__item col-xs-6 col-sm-3 col-md-3 col-lg-3\">
                    <div class=\"g-users-gallery__content\">
                        <div class=\"g-users-gallery__photo\">
                            <a class=\"g-pic-border g-rounded\" href=\"";
            // line 48
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
            // line 49
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
            // line 50
            echo "                            </a>
                            <div class=\"g-users-gallery__actions\">
                                <div class=\"g-photo-actions text-overflow\">
                                    ";
            // line 53
            if ((($context["tab"] ?? null) == "my_favs")) {
                // line 54
                echo "                                        ";
                if ($this->getAttribute($this->getAttribute($context["item"], "user", []), "id", [])) {
                    // line 55
                    echo "                                            <a id=\"favorites_remove_";
                    echo $this->getAttribute($this->getAttribute($context["item"], "user", []), "id", []);
                    echo "\" data-pjax=\"0\"
                                               href=\"";
                    // line 56
                    echo ($context["site_url"] ?? null);
                    echo "favorites/remove/";
                    echo $this->getAttribute($this->getAttribute($context["item"], "user", []), "id", []);
                    echo "\"
                                               data-userid=\"";
                    // line 57
                    echo $this->getAttribute($this->getAttribute($context["item"], "user", []), "id", []);
                    echo "\"
                                               title=\"";
                    // line 58
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("action_remove"                    ,"favorites"                    ,""                    ,"button"                    ,                    );
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
                // line 62
                echo "                                    ";
            }
            // line 63
            echo "                                </div>
                            </div>
                        </div>
                        <div class=\"g-users-gallery__info\">
                            <div class=\"text-overflow\">
                                <a class=\"g-users-gallery__name\" href=\"";
            // line 68
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
            echo "\">";
            echo $this->getAttribute($this->getAttribute($context["item"], "user", []), "output_name", []);
            echo "</a>, ";
            echo $this->getAttribute($this->getAttribute($context["item"], "user", []), "age", []);
            echo "
                            </div>
                            ";
            // line 70
            if ($this->getAttribute($this->getAttribute($context["item"], "user", []), "location", [])) {
                // line 71
                echo "                                <div class=\"text-overflow\">
                                    ";
                // line 72
                echo $this->getAttribute($this->getAttribute($context["item"], "user", []), "location", []);
                echo "
                                </div>
                            ";
            }
            // line 75
            echo "                            <div class=\"text-overflow\">
                                ";
            // line 76
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
            // line 77
            echo "                            </div>
                        </div>
                    </div>
                </div>
            ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 82
            echo "                <div class=\"empty text-center p10 pt20\">
                    ";
            // line 83
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("empty_result"            ,"favorites"            ,            );
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
            // line 84
            echo "                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 86
        echo "        </div>
        ";
        // line 87
        if (($context["list"] ?? null)) {
            // line 88
            echo "            <div id=\"pages_block_2\" class=\"tac\">
                ";
            // line 89
            $context["page_data"] = twig_array_merge(($context["page_data"] ?? null), ["type" => "full"]);
            // line 90
            echo "                ";
            $module =             null;
            $helper =             'start';
            $name =             'pagination';
            $params = array(($context["page_data"] ?? null)            ,"full"            ,            );
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
            // line 91
            echo "            </div>
        ";
        }
        // line 93
        echo "    </div>
</div>

";
        // line 96
        $this->loadTemplate("@app/footer.twig", "list.twig", 96)->display($context);
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
        return array (  556 => 96,  551 => 93,  547 => 91,  525 => 90,  523 => 89,  520 => 88,  518 => 87,  515 => 86,  508 => 84,  487 => 83,  484 => 82,  475 => 77,  454 => 76,  451 => 75,  445 => 72,  442 => 71,  440 => 70,  412 => 68,  405 => 63,  402 => 62,  376 => 58,  372 => 57,  366 => 56,  361 => 55,  358 => 54,  356 => 53,  351 => 50,  330 => 49,  307 => 48,  300 => 45,  295 => 44,  289 => 43,  286 => 42,  258 => 36,  232 => 34,  226 => 30,  224 => 29,  219 => 26,  198 => 25,  175 => 24,  169 => 23,  165 => 21,  144 => 20,  121 => 19,  115 => 18,  107 => 12,  85 => 11,  64 => 10,  57 => 5,  36 => 4,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "list.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\favorites\\views\\flatty\\list.twig");
    }
}
