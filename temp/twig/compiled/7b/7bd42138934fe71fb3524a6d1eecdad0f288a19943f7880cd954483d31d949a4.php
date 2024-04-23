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

/* visits.twig */
class __TwigTemplate_fca4640069434a38f8f116c617edacf0a44f707c40e20695599b41008d426075 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "visits.twig", 1)->display($context);
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
<div class=\"col-xs-12 col-sm-9 col-md-9 col-lg-9 user-search\">
    <h1>
        ";
        // line 15
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
        // line 16
        echo "    </h1>
    <div class=\"g-flatty-block\">
        <div class=\"b-tabs b-tabs_wrapper\">
            <div class=\"b-tabs__item ";
        // line 19
        if ((($context["views_type"] ?? null) == "my_guests")) {
            echo "active";
        }
        echo "\">
                <a class=\"b-tabs__text\" href=\"";
        // line 20
        $module =         null;
        $helper =         'seo';
        $name =         'seolink';
        $params = array("users"        ,"my_guests"        ,        );
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
        // line 21
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_my_guests"        ,"users"        ,        );
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
        // line 22
        echo "                </a>
            </div>
            <div class=\"b-tabs__item  ";
        // line 24
        if ((($context["views_type"] ?? null) == "my_visits")) {
            echo "active";
        }
        echo "\">
                <a class=\"b-tabs__text\" href=\"";
        // line 25
        $module =         null;
        $helper =         'seo';
        $name =         'seolink';
        $params = array("users"        ,"my_visits"        ,        );
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
        // line 26
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_my_visits"        ,"users"        ,        );
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
        echo "                </a>
            </div>
        </div>

        <div class=\"row g-flatty-block__control\" id=\"sorter_block\">
            <div class=\"pull-left pl15\">
                <div class=\"form-inline\">
                    <select class=\"form-control\" name=\"period\" onchange=\"locationHref(('";
        // line 34
        $module =         null;
        $helper =         'seo';
        $name =         'seolink';
        $params = array("users"        ,($context["views_type"] ?? null)        ,"[period]"        ,        );
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
        echo "').replace('[period]', this.value));\">
                        <option value=\"all\" ";
        // line 35
        if ((($context["period"] ?? null) == "all")) {
            echo "selected";
        }
        echo ">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("all_time"        ,"users"        ,        );
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
        echo "</option>
                        <option value=\"month\" ";
        // line 36
        if ((($context["period"] ?? null) == "month")) {
            echo "selected";
        }
        echo ">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("last_month"        ,"users"        ,        );
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
        echo "</option>
                        <option value=\"week\" ";
        // line 37
        if ((($context["period"] ?? null) == "week")) {
            echo "selected";
        }
        echo ">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("last_week"        ,"users"        ,        );
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
        echo "</option>
                        <option value=\"today\" ";
        // line 38
        if ((($context["period"] ?? null) == "today")) {
            echo "selected";
        }
        echo ">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("today"        ,"users"        ,        );
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
        echo "</option>
                    </select>
                </div>
            </div>

            ";
        // line 43
        if (($context["users"] ?? null)) {
            // line 44
            echo "                <div class=\"st-info\">
                    <div class=\"lh30\">
                        ";
            // line 46
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("header_users_found"            ,"users"            ,            );
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
            echo ": ";
            echo $this->getAttribute(($context["page_data"] ?? null), "total_rows", []);
            echo "
                    </div>
                </div>

                <div class=\"pull-right pr15\">
                    <div class=\"fright lh30 search-top-pager\">
                        ";
            // line 52
            $context["page_data"] = twig_array_merge(($context["page_data"] ?? null), ["type" => "cute"]);
            // line 53
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
            // line 54
            echo "                    </div>
                </div>
            ";
        }
        // line 57
        echo "        </div>

        <div id=\"users_block\" class=\"row g-users-gallery\">
            ";
        // line 60
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["users"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 61
            echo "                ";
            $context["viewer_id"] = $this->getAttribute($context["item"], "id", []);
            // line 62
            echo "                ";
            if (($context["viewer_id"] ?? null)) {
                // line 63
                echo "                    <div id=\"item-block-";
                echo $this->getAttribute($context["item"], "id", []);
                echo "\" class=\"g-users-gallery__item col-xs-6 col-sm-3 col-md-3 col-lg-3\">
                        <div class=\"g-users-gallery__content\">
                            <div class=\"g-users-gallery__photo\">
                                ";
                // line 66
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("text_user_logo"                ,"users"                ,""                ,"button"                ,($context["item"] ?? null)                ,                );
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
                $context['text_user_logo'] = $result;
                // line 67
                echo "                                <a class=\"g-pic-border g-rounded\" href=\"";
                $module =                 null;
                $helper =                 'seo';
                $name =                 'seolink';
                $params = array("users"                ,"view"                ,($context["item"] ?? null)                ,                );
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
                // line 68
                $module =                 null;
                $helper =                 'users';
                $name =                 'formatAvatar';
                $params = array(["user" => ($context["item"] ?? null), "size" => "great"]                ,                );
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
                // line 69
                echo "                                </a>
                            </div>
                            <div class=\"g-users-gallery__info\">
                                <div class=\"subtext\">
                                    ";
                // line 73
                $context["vide_date"] = $this->getAttribute(($context["view_dates"] ?? null), ($context["viewer_id"] ?? null));
                // line 74
                echo "                                    ";
                $module =                 null;
                $helper =                 'date_format';
                $name =                 'tpl_date_format';
                $params = array(($context["vide_date"] ?? null)                ,$this->getAttribute(($context["date_format_st"] ?? null), "date_time_literal", [])                ,                );
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
                echo "                                </div>
                                <div class=\"text-overflow\">
                                    <a class=\"g-users-gallery__name\" href=\"";
                // line 77
                $module =                 null;
                $helper =                 'seo';
                $name =                 'seolink';
                $params = array("users"                ,"view"                ,($context["item"] ?? null)                ,                );
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
                echo $this->getAttribute($context["item"], "output_name", []);
                echo "</a>
                                    ";
                // line 78
                if ($this->getAttribute($context["item"], "age", [])) {
                    // line 79
                    echo "                                    , ";
                    echo $this->getAttribute($context["item"], "age", []);
                    echo "
                                    ";
                }
                // line 81
                echo "                                </div>
                                ";
                // line 82
                if ($this->getAttribute($context["item"], "location", [])) {
                    // line 83
                    echo "                                    <div class=\"text-overflow\">
                                        ";
                    // line 84
                    echo $this->getAttribute($context["item"], "location", []);
                    echo "
                                    </div>
                                ";
                }
                // line 87
                echo "                            </div>
                        </div>
                    </div>
                ";
            } else {
                // line 91
                echo "                    <div id=\"item-block-";
                echo $this->getAttribute($context["item"], "id", []);
                echo "\" class=\"g-users-gallery__item col-xs-6 col-sm-3 col-md-3 col-lg-3\">
                        <div class=\"g-users-gallery__content\">
                            <div class=\"g-users-gallery__photo\">
                                ";
                // line 94
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("text_user_logo"                ,"users"                ,""                ,"button"                ,($context["item"] ?? null)                ,                );
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
                $context['text_user_logo'] = $result;
                // line 95
                echo "                                <a class=\"g-pic-border g-rounded\" href=\"";
                $module =                 null;
                $helper =                 'seo';
                $name =                 'seolink';
                $params = array("users"                ,"untitled"                ,                );
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
                // line 96
                $module =                 null;
                $helper =                 'users';
                $name =                 'formatAvatar';
                $params = array(["user" => ($context["item"] ?? null), "size" => "great"]                ,                );
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
                // line 97
                echo "                                </a>
                            </div>
                            <div class=\"g-users-gallery__info\">
                                <div class=\"text-overflow\">
                                    <a class=\"g-users-gallery__name\" href=\"";
                // line 101
                $module =                 null;
                $helper =                 'seo';
                $name =                 'seolink';
                $params = array("users"                ,"untitled"                ,                );
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
                echo $this->getAttribute($context["item"], "output_name", []);
                echo "</a>
                                </div>
                            </div>
                        </div>
                    </div>
                ";
            }
            // line 107
            echo "            ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 108
            echo "                <div class=\"line empty center p10 pt20\">
                    ";
            // line 109
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("header_users_found"            ,"users"            ,            );
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
            echo ": ";
            echo $this->getAttribute(($context["page_data"] ?? null), "total_rows", []);
            echo "
                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 112
        echo "        </div>
        ";
        // line 113
        if (($context["users"] ?? null)) {
            // line 114
            echo "            <div id=\"pages_block_2\" class=\"tac\">
                ";
            // line 115
            $context["page_data"] = twig_array_merge(($context["page_data"] ?? null), ["type" => "full"]);
            // line 116
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
            // line 117
            echo "            </div>
        ";
        }
        // line 119
        echo "    </div>
</div>
";
        // line 121
        $this->loadTemplate("@app/footer.twig", "visits.twig", 121)->display($context);
    }

    public function getTemplateName()
    {
        return "visits.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  835 => 121,  831 => 119,  827 => 117,  805 => 116,  803 => 115,  800 => 114,  798 => 113,  795 => 112,  765 => 109,  762 => 108,  757 => 107,  727 => 101,  721 => 97,  700 => 96,  676 => 95,  655 => 94,  648 => 91,  642 => 87,  636 => 84,  633 => 83,  631 => 82,  628 => 81,  622 => 79,  620 => 78,  595 => 77,  591 => 75,  569 => 74,  567 => 73,  561 => 69,  540 => 68,  516 => 67,  495 => 66,  488 => 63,  485 => 62,  482 => 61,  477 => 60,  472 => 57,  467 => 54,  445 => 53,  443 => 52,  413 => 46,  409 => 44,  407 => 43,  376 => 38,  349 => 37,  322 => 36,  295 => 35,  272 => 34,  263 => 27,  242 => 26,  219 => 25,  213 => 24,  209 => 22,  188 => 21,  165 => 20,  159 => 19,  154 => 16,  133 => 15,  126 => 10,  105 => 9,  81 => 8,  59 => 7,  38 => 6,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "visits.twig", "/home/mliadov/public_html/application/modules/users/views/flatty/visits.twig");
    }
}
