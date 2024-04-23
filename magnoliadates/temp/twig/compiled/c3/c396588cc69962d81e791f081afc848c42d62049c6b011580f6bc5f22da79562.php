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

/* index.twig */
class __TwigTemplate_3e6f34ef4d477495cadd5ad84a33597dd7ae7263c6c9c078b78578332025dceb extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "index.twig", 1)->display($context);
        // line 2
        echo "
<div class=\"col-xs-12\">
    <h1 data-title=\"";
        // line 4
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("kisses"        ,"kisses"        ,        );
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
        echo "\" data-id=\"kisses-title\" id=\"kisses-title\">
        ";
        // line 5
        if ((($context["kiss_section"] ?? null) == "inbox")) {
            // line 6
            echo "            ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("inbox"            ,"kisses"            ,            );
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
        } else {
            // line 8
            echo "            ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("outbox"            ,"kisses"            ,            );
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
            echo "        ";
        }
        // line 10
        echo "    </h1>
</div>

<!--Profile -->
<div class=\"col-xs-12 col-sm-3 col-md-3 col-lg-3\">
    <div class=\"hide-in-mobile\">
        ";
        // line 16
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
        // line 17
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
        // line 18
        echo "    </div>
</div>
<!--Profile -->

<div class=\"col-xs-12 col-sm-9 col-md-6 col-lg-6\">
    <div class=\"content-block kisses g-col\">
        <div id=\"kisses_content\" class=\"search-type-page clearfix\">
            <div class=\"b-tabs b-tabs_wrapper\">
                <div class=\"b-tabs__item ";
        // line 26
        if ((($context["kiss_section"] ?? null) == "inbox")) {
            echo "active";
        }
        echo "\">
                    <a class=\"b-tabs__text\" data-pjax-no-scroll=\"1\" href=\"";
        // line 27
        $module =         null;
        $helper =         'seo';
        $name =         'seolink';
        $params = array("kisses"        ,"inbox"        ,        );
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
        // line 28
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("inbox"        ,"kisses"        ,        );
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
        echo "                    </a>
                </div>
                <div class=\"b-tabs__item  ";
        // line 31
        if ((($context["kiss_section"] ?? null) == "outbox")) {
            echo "active";
        }
        echo "\">
                    <a class=\"b-tabs__text\" data-pjax-no-scroll=\"1\" href=\"";
        // line 32
        $module =         null;
        $helper =         'seo';
        $name =         'seolink';
        $params = array("kisses"        ,"outbox"        ,        );
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
        // line 33
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("outbox"        ,"kisses"        ,        );
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
        // line 34
        echo "                    </a>
                </div>
            </div>

            ";
        // line 38
        if ((twig_length_filter($this->env, ($context["kisses"] ?? null)) > 0)) {
            // line 39
            echo "                <div class=\"sorter short-line\" id=\"sorter_block\">
                    <div class=\"fright\">
                        ";
            // line 41
            $context["page_data"] = twig_array_merge(($context["page_data"] ?? null), ["type" => "cute"]);
            // line 42
            echo "                        ";
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
            // line 43
            echo "                    </div>
                </div>
            ";
        }
        // line 46
        echo "
            <div class=\"user-search mt20\">
                ";
        // line 48
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["kisses"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["kiss"]) {
            // line 49
            echo "                    ";
            if ((($context["kiss_section"] ?? null) == "outbox")) {
                // line 50
                echo "                        ";
                $context["uid"] = $this->getAttribute($context["kiss"], "user_to", []);
                // line 51
                echo "                    ";
            } else {
                // line 52
                echo "                        ";
                $context["uid"] = $this->getAttribute($context["kiss"], "user_from", []);
                // line 53
                echo "                    ";
            }
            // line 54
            echo "                    <div class=\"";
            if (((($context["kiss_section"] ?? null) == "outbox") && ($this->getAttribute($context["kiss"], "mark", []) == "0"))) {
                echo "bold";
            }
            echo " user-list-item clearfix \"
                        data-id=\"";
            // line 55
            echo $this->getAttribute($context["kiss"], "id", []);
            echo "\">
                        <div class=\"photo col-xs-5 col-sm-5 col-md-5 col-lg-5\">
                            <a href=\"#\" data-action=\"set_user_ids\" data-gid=\"kisses\" data-href=\"";
            // line 57
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("users"            ,"view"            ,["id" => ($context["uid"] ?? null)]            ,            );
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
            echo "\" target=\"_blank\">
                                <img src=\"";
            // line 58
            echo $this->getAttribute($this->getAttribute($context["kiss"], "user_logo", []), "small", []);
            echo "\"
                                     alt=\"";
            // line 59
            echo $this->getAttribute($context["kiss"], "output_name", []);
            echo "\"
                                     title=\"";
            // line 60
            echo $this->getAttribute($context["kiss"], "output_name", []);
            echo "\" />
                            </a>
                        </div>
                        <div class=\" col-xs-1 col-sm-1 col-md-1 col-lg-1\">
                            <ins class=\"fa fa-arrow-";
            // line 64
            if ((($context["kiss_section"] ?? null) == "inbox")) {
                echo "right";
            } else {
                echo "left";
            }
            echo "\"></ins>
                        </div>
                        <div class=\" col-xs-2 col-sm-2 col-md-2 col-lg-2\">
                            <img src=\"";
            // line 67
            echo $this->getAttribute($this->getAttribute($this->getAttribute($context["kiss"], "images", []), "thumbs", []), "kisses", []);
            echo "\" alt=\"";
            echo $this->getAttribute($context["kiss"], "id", []);
            echo "\">
                        </div>
                        <div class=\" col-xs-4 col-sm-4 col-md-4 col-lg-4 kisses-message\" data-text=\"";
            // line 69
            echo $this->getAttribute($context["kiss"], "message", []);
            echo "\"></div>
                        <div class=\"col-xs-12\">
                             <a href=\"#\" data-action=\"set_user_ids\" data-gid=\"kisses\" data-href=\"";
            // line 71
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("users"            ,"view"            ,["id" => ($context["uid"] ?? null)]            ,            );
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
            echo "\" target=\"_blank\">";
            echo $this->getAttribute($context["kiss"], "output_name", []);
            echo "</a>
                        </div>
                        <div class=\" col-xs-12\">
                            ";
            // line 74
            $module =             null;
            $helper =             'date_format';
            $name =             'tpl_date_format';
            $params = array($this->getAttribute(($context["kiss"] ?? null), "date_created", [])            ,$this->getAttribute(($context["date_format_st"] ?? null), "date_time_literal", [])            ,            );
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
            // line 75
            echo "                        </div>
                    </div>
                ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 78
            echo "                    <div class=\"text-center p10 pt20\">";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("no_kisses"            ,"kisses"            ,            );
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
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['kiss'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 80
        echo "            </div>
            
            <script type=\"text/javascript\">
                \$(function(){
                    \$('.kisses-message').each(function(i, elem) {
                        \$(elem).html(twemoji.parse(eval(\"'\" + \$(elem).data('text') + \"'\")));
                    });
                });
            </script>

            ";
        // line 90
        if ((twig_length_filter($this->env, ($context["kisses"] ?? null)) > 0)) {
            // line 91
            echo "                <div>
                    ";
            // line 92
            $context["page_data"] = twig_array_merge(($context["page_data"] ?? null), ["type" => "full"]);
            // line 93
            echo "                    ";
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
            // line 94
            echo "                </div>
            ";
        }
        // line 96
        echo "        </div>
    </div>
    <div class=\"clr\"></div>
</div>

<div class=\"col-xs-12 col-sm-9 col-md-3 col-lg-3 pull-right\">
    <div id=\"active_users\" class=\"clearfix mb10\">
        ";
        // line 103
        $module =         null;
        $helper =         'users';
        $name =         'active_users_block';
        $params = array(["count" => "16"]        ,        );
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
        // line 104
        echo "    </div>
    <div id=\"recent_photo\" class=\"clearfix mb10\">
        ";
        // line 106
        $module =         null;
        $helper =         'media';
        $name =         'recent_media_block';
        $params = array(["upload_gid" => "photo", "count" => "16"]        ,        );
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
        // line 107
        echo "    </div>
</div>

";
        // line 110
        $this->loadTemplate("@app/footer.twig", "index.twig", 110)->display($context);
    }

    public function getTemplateName()
    {
        return "index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  601 => 110,  596 => 107,  575 => 106,  571 => 104,  550 => 103,  541 => 96,  537 => 94,  515 => 93,  513 => 92,  510 => 91,  508 => 90,  496 => 80,  468 => 78,  461 => 75,  440 => 74,  413 => 71,  408 => 69,  401 => 67,  391 => 64,  384 => 60,  380 => 59,  376 => 58,  353 => 57,  348 => 55,  341 => 54,  338 => 53,  335 => 52,  332 => 51,  329 => 50,  326 => 49,  321 => 48,  317 => 46,  312 => 43,  290 => 42,  288 => 41,  284 => 39,  282 => 38,  276 => 34,  255 => 33,  232 => 32,  226 => 31,  222 => 29,  201 => 28,  178 => 27,  172 => 26,  162 => 18,  140 => 17,  119 => 16,  111 => 10,  108 => 9,  86 => 8,  83 => 7,  61 => 6,  59 => 5,  36 => 4,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "index.twig", "/home/mliadov/public_html/application/modules/kisses/views/flatty/index.twig");
    }
}
