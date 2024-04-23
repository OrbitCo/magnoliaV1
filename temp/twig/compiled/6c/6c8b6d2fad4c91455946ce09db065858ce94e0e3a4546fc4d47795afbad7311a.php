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

/* users_list_block.twig */
class __TwigTemplate_3df2e755a7b653ad90d99dfd12327aefef601f45ce149de68ed750d25ac794fc extends \Twig\Template
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
        $helper =         'users';
        $name =         'reFormatUsers';
        $params = array(["users" => ($context["users"] ?? null), "return" => true]        ,        );
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
        $context['users'] = $result;
        // line 2
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
        $context['banner_320_250'] = $result;
        // line 3
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
        $context['banner_320_75'] = $result;
        // line 4
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
        $context['banner_980_90'] = $result;
        // line 5
        if (($this->getAttribute(($context["page_data"] ?? null), "cur_page", []) > 1)) {
            // line 6
            echo "    ";
            $context["add_loop"] = ($this->getAttribute(($context["page_data"] ?? null), "prev_page", []) * $this->getAttribute(($context["page_data"] ?? null), "per_page", []));
        } else {
            // line 8
            echo "    ";
            $context["add_loop"] = 0;
        }
        // line 10
        if (twig_test_empty(($context["users"] ?? null))) {
            // line 11
            echo "    <h2 class=\"text-center p10\">
        ";
            // line 12
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
    </h2>
";
        }
        // line 15
        if (((($context["users"] ?? null) && (($context["hide_dir"] ?? null) != "previous")) && ($this->getAttribute(($context["page_data"] ?? null), "type", []) == "scroll"))) {
            // line 16
            echo "    <div id=\"pages_block_1\" class=\"tac\">
        ";
            // line 17
            $context["page_data"] = twig_array_merge(($context["page_data"] ?? null), ["items" => "previous"]);
            // line 18
            echo "        ";
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
            // line 19
            echo "    </div>
";
        } elseif ((        // line 20
($context["users"] ?? null) && ($this->getAttribute(($context["page_data"] ?? null), "type", []) != "scroll"))) {
            // line 21
            echo "    ";
            if ( !twig_test_empty(($context["sort_data"] ?? null))) {
                // line 22
                echo "        <div class=\"sorter-block clearfix\" id=\"sorter_block\">
            <div class=\"pull-left pl15\">
                ";
                // line 24
                $module =                 null;
                $helper =                 'start';
                $name =                 'sorter';
                $params = array(["links" => $this->getAttribute(                // line 25
($context["sort_data"] ?? null), "links", []), "order" => $this->getAttribute(                // line 26
($context["sort_data"] ?? null), "order", []), "direction" => $this->getAttribute(                // line 27
($context["sort_data"] ?? null), "direction", []), "url" => $this->getAttribute(                // line 28
($context["sort_data"] ?? null), "url", [])]                ,                );
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
                echo "            </div>
            <div class=\"st-info\">
                <div class=\"lh30\">
                    ";
                // line 33
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("header_users_found"                ,"users"                ,                );
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
                // line 38
                $context["page_data"] = twig_array_merge(($context["page_data"] ?? null), ["type" => "cute"]);
                // line 39
                echo "                    ";
                $module =                 null;
                $helper =                 'start';
                $name =                 'pagination';
                $params = array(($context["page_data"] ?? null)                ,                );
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
                // line 40
                echo "                </div>
            </div>
        </div>
    ";
            }
        }
        // line 45
        echo "<div class=\"";
        if (($this->getAttribute(($context["page_data"] ?? null), "view_type", []) == "gallery")) {
            echo "row g-users-gallery";
        } else {
            echo "user-list";
        }
        echo "\" data-action=\"set-page\" data-page=\"";
        echo $this->getAttribute(($context["page_data"] ?? null), "cur_page", []);
        echo "\">
    ";
        // line 46
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["users"] ?? null));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["ukey"] => $context["user"]) {
            // line 47
            echo "        ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("text_user_logo"            ,"users"            ,""            ,"button"            ,($context["user"] ?? null)            ,            );
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
            // line 48
            echo "        ";
            if (($this->getAttribute(($context["page_data"] ?? null), "view_type", []) == "gallery")) {
                // line 49
                echo "            <div class=\"g-users-gallery__item col-xs-6 col-sm-3 col-md-3 col-lg-2 ";
                if (($this->getAttribute($context["user"], "is_highlight_in_search", []) || $this->getAttribute($context["user"], "leader_bid", []))) {
                    echo "highlight";
                }
                echo "\">
                <div class=\"g-users-gallery__content\">
                    <div class=\"g-users-gallery__photo\">
                        <a class=\"g-pic-border g-rounded\"  onclick=\"sendAnalytics('', 'user_profile', 'view_user_search_block');\"  href=\"";
                // line 52
                $module =                 null;
                $helper =                 'seo';
                $name =                 'seolink';
                $params = array("users"                ,"view"                ,($context["user"] ?? null)                ,                );
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
                // line 53
                $module =                 null;
                $helper =                 'users';
                $name =                 'formatAvatar';
                $params = array(["user" => ($context["user"] ?? null), "size" => "great"]                ,                );
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
                echo "                        </a>
                    </div>
                    <div class=\"g-users-gallery__info\">
                        <div class=\"text-overflow\">
                            ";
                // line 58
                $module =                 null;
                $helper =                 'users';
                $name =                 'userName';
                $params = array(["format" => "age", "user" => ($context["user"] ?? null), "is_link" => 1]                ,                );
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
                echo "                        </div>
                        ";
                // line 60
                if ($this->getAttribute($context["user"], "location", [])) {
                    // line 61
                    echo "                            <div class=\"text-overflow\">
                                ";
                    // line 62
                    echo $this->getAttribute($context["user"], "location", []);
                    echo "
                            </div>
                        ";
                }
                // line 65
                echo "                    </div>
                </div>
            </div>
            ";
                // line 68
                if (($context["ukey"] == 5)) {
                    // line 69
                    echo "                ";
                    if (($context["banner_980_90"] ?? null)) {
                        // line 70
                        echo "                    <div class=\"col-sm-12 banner-unsupported\">
                        ";
                        // line 71
                        echo ($context["banner_980_90"] ?? null);
                        echo "
                    </div>
                    <div class=\"clearfix\"></div>
                ";
                    }
                    // line 75
                    echo "            ";
                }
                // line 76
                echo "            ";
                if ((((($context["ukey"] == 11) && ($this->getAttribute(($context["page_data"] ?? null), "cur_page", []) == 1)) || (0 == ($this->getAttribute($context["loop"], "index", []) + ($context["add_loop"] ?? null)) % 36)) || (($context["ukey"] == (($context["users_count"] ?? null) - 1)) && ($context["ukey"] < 11)))) {
                    // line 77
                    echo "                ";
                    if ((($context["banner_320_250"] ?? null) || ($context["banner_320_75"] ?? null))) {
                        // line 78
                        echo "                    <div class=\"col-sm-12\">
                        <div class=\"row\">
                            <div class=\"col-xs-6\">
                                <div class=\"banner-unsupported\">
                                    ";
                        // line 82
                        echo ($context["banner_320_250"] ?? null);
                        echo "
                                </div>
                            </div>
                            <div class=\"col-xs-6\">
                                <div class=\"banner-unsupported\">
                                    ";
                        // line 87
                        echo ($context["banner_320_75"] ?? null);
                        echo "
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=\"clearfix\"></div>
                ";
                    }
                    // line 94
                    echo "            ";
                }
                // line 95
                echo "        ";
            } else {
                // line 96
                echo "            ";
                if (($context["ukey"] == 0)) {
                    // line 97
                    echo "                ";
                    if (($context["banner_980_90"] ?? null)) {
                        // line 98
                        echo "                    <div class=\"col-sm-12 banner-unsupported\">
                        ";
                        // line 99
                        echo ($context["banner_980_90"] ?? null);
                        echo "
                    </div>
                    <div class=\"clearfix\"></div>
                ";
                    }
                    // line 103
                    echo "            ";
                } elseif (($context["ukey"] == 3)) {
                    // line 104
                    echo "                ";
                    if ((($context["banner_320_250"] ?? null) || ($context["banner_320_75"] ?? null))) {
                        // line 105
                        echo "                    <div class=\"col-sm-12\">
                        <div class=\"row\">
                            <div class=\"col-xs-6\">
                                <div class=\"banner-unsupported\">
                                    ";
                        // line 109
                        echo ($context["banner_320_250"] ?? null);
                        echo "
                                </div>
                            </div>
                            <div class=\"col-xs-6\">
                                <div class=\"banner-unsupported\">
                                    ";
                        // line 114
                        echo ($context["banner_320_75"] ?? null);
                        echo "
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=\"clearfix\"></div>
                ";
                    }
                    // line 121
                    echo "            ";
                }
                // line 122
                echo "            <div id=\"item-block-";
                echo $this->getAttribute($context["user"], "id", []);
                echo "\"
                 class=\"user-list-item clearfix ";
                // line 123
                if ((($this->getAttribute($context["user"], "is_highlight_in_search", []) || $this->getAttribute(                // line 124
$context["user"], "leader_bid", [])) || ($this->getAttribute(                // line 125
$context["user"], "is_up_in_search", []) && $this->getAttribute(($context["page_data"] ?? null), "use_leader", [])))) {
                    echo "highlight";
                }
                echo "\">
                ";
                // line 126
                if ($this->getAttribute($context["user"], "leader_bid", [])) {
                    // line 127
                    echo "                    <div class=\"lift_up\">
                        ";
                    // line 128
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("header_leader"                    ,"users"                    ,                    );
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
                    // line 129
                    echo "                    </div>
                ";
                }
                // line 131
                echo "
                <div class=\"col-xs-12 col-sm-12 col-md-4 col-lg-4 no-padding-left\">
                    <div class=\"image\">
                        <a class=\"g-pic-border g-rounded\"  onclick=\"sendAnalytics('dp_user_view_user_search_block', 'user_profile', 'view_user_search_block');\" href=\"";
                // line 134
                $module =                 null;
                $helper =                 'seo';
                $name =                 'seolink';
                $params = array("users"                ,"view"                ,($context["user"] ?? null)                ,                );
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
                // line 135
                $module =                 null;
                $helper =                 'users';
                $name =                 'formatAvatar';
                $params = array(["user" => ($context["user"] ?? null), "size" => "small"]                ,                );
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
                // line 136
                echo "                        </a>
                    </div>
                    <div class=\"descr-1\">
                        <div class=\"\">
                            <a href=\"";
                // line 140
                $module =                 null;
                $helper =                 'seo';
                $name =                 'seolink';
                $params = array("users"                ,"view"                ,($context["user"] ?? null)                ,                );
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
                echo $this->getAttribute($context["user"], "output_name", []);
                echo "</a>, ";
                echo $this->getAttribute($context["user"], "age", []);
                echo "
                        </div>
                        ";
                // line 142
                if ($this->getAttribute($context["user"], "location", [])) {
                    // line 143
                    echo "                            <div class=\"\">
                                <i class=\"fas fa-map-marker-alt g\"></i>
                                <span>";
                    // line 145
                    echo $this->getAttribute($context["user"], "location", []);
                    echo "</span>
                            </div>
                        ";
                }
                // line 148
                echo "
                        ";
                // line 149
                if (($context["pm_installed"] ?? null)) {
                    // line 150
                    echo "                            <div class=\"\">
                                <span>
                                    ";
                    // line 152
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("field_looking_user_type"                    ,"users"                    ,                    );
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
                    // line 153
                    echo "                                    ";
                    echo $this->getAttribute($context["user"], "looking_user_type_str", []);
                    echo ", ";
                    echo $this->getAttribute($context["user"], "age_min", []);
                    echo "-";
                    echo $this->getAttribute($context["user"], "age_max", []);
                    echo "
                                </span>
                            </div>
                        ";
                }
                // line 157
                echo "                    </div>
                </div>
                <div class=\"col-xs-12 col-sm-12 col-md-4 col-lg-4\">
                    <div class=\"descr-2\">
                        <span class=\"italic\">
                            ";
                // line 162
                $module =                 null;
                $helper =                 'utils';
                $name =                 'truncate';
                $params = array($this->getAttribute(($context["user"] ?? null), "fe_about_me", [])                ,100                ,                );
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
                // line 163
                echo "                        </span>
                    </div>
                </div>
                <div class=\"col-xs-12 col-sm-12 col-md-4 col-lg-4 no-padding-right\">
                    <div class=\"descr-3\">
                        <div class=\"rating-ul-block fleft\">
                            ";
                // line 169
                $module =                 null;
                $helper =                 'ratings';
                $name =                 'get_rate_item';
                $params = array(["object_id" => $this->getAttribute(($context["user"] ?? null), "id", []), "type_gid" => "users_object"]                ,                );
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
                // line 170
                echo "                        </div>
                        <div class=\"fright\">
                            ";
                // line 172
                $module =                 null;
                $helper =                 'menu';
                $name =                 'buttonActionMenu';
                $params = array(["user_id" => $this->getAttribute(($context["user"] ?? null), "id", [])]                ,                );
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
                // line 173
                echo "                        </div>
                    </div>
                </div>
            </div>
        ";
            }
            // line 178
            echo "    ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['ukey'], $context['user'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 179
        echo "</div>

";
        // line 181
        if (((($context["users"] ?? null) && (($context["hide_dir"] ?? null) != "next")) && ($this->getAttribute(($context["page_data"] ?? null), "type", []) == "scroll"))) {
            // line 182
            echo "    <div id=\"pages_block_2\" class=\"tac\">
        ";
            // line 183
            $context["page_data"] = twig_array_merge(($context["page_data"] ?? null), ["items" => "next"]);
            // line 184
            echo "        ";
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
            // line 185
            echo "    </div>
";
        } elseif ((        // line 186
($context["users"] ?? null) && ($this->getAttribute(($context["page_data"] ?? null), "type", []) != "scroll"))) {
            // line 187
            echo "    <div id=\"pages_block_2\" class=\"tac\">
        ";
            // line 188
            $context["page_data"] = twig_array_merge(($context["page_data"] ?? null), ["type" => "full"]);
            // line 189
            echo "        ";
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
            // line 190
            echo "    </div>
";
        }
        // line 192
        echo "
<script>
    ";
        // line 194
        if ( !($context["show_list_buttons"] ?? null)) {
            // line 195
            echo "        \$(\".user-menu a\").each(function () {
            \$(this).unbind('click').removeAttr('onclick').html('<span class=\"dislink\">' + \$(this).html() + '</span>');
        });
        \$(\".lider-link\").each(function () {
            \$(this).html('<a href=\"javascript:void(0)\" class=\"dislink\">' + \$(this).children().html() + '</a>');
        });

        \$(\".dislink\").each(function () {
            \$(this).on('click', function (event) {
                event.preventDefault();
                event.stopPropagation();
                \$.ajax({
                    url: '";
            // line 207
            echo ($context["site_url"] ?? null);
            echo "' + 'users/prevent_view',
                    success: function (data) {
                        var list_view_request_window = new loadingContent({
                            loadBlockWidth: '500px',
                            linkerObjID: \$(this).attr('id'),
                            loadBlockLeftType: 'center',
                            loadBlockTopType: 'center',
                            closeBtnClass: 'w'
                        });
                        list_view_request_window.show_load_block(data);
                    },
                    dataType: 'html',
                    type: 'POST'
                });
            });
        });
    ";
        }
        // line 224
        echo "
        \$('.user-gallery').not('.w-descr').find('.photo')
                .off('mouseenter').on('mouseenter', function () {
            \$(this).find('.info').stop().slideDown(100);
        }).off('mouseleave').on('mouseleave', function () {
            \$(this).find('.info').stop(true).delay(100).slideUp(100);
        });

        \$('#main_page').click(function () {
            \$('.umb').hide();
        });
</script>
";
    }

    public function getTemplateName()
    {
        return "users_list_block.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  934 => 224,  914 => 207,  900 => 195,  898 => 194,  894 => 192,  890 => 190,  868 => 189,  866 => 188,  863 => 187,  861 => 186,  858 => 185,  836 => 184,  834 => 183,  831 => 182,  829 => 181,  825 => 179,  811 => 178,  804 => 173,  783 => 172,  779 => 170,  758 => 169,  750 => 163,  729 => 162,  722 => 157,  710 => 153,  689 => 152,  685 => 150,  683 => 149,  680 => 148,  674 => 145,  670 => 143,  668 => 142,  640 => 140,  634 => 136,  613 => 135,  590 => 134,  585 => 131,  581 => 129,  560 => 128,  557 => 127,  555 => 126,  549 => 125,  548 => 124,  547 => 123,  542 => 122,  539 => 121,  529 => 114,  521 => 109,  515 => 105,  512 => 104,  509 => 103,  502 => 99,  499 => 98,  496 => 97,  493 => 96,  490 => 95,  487 => 94,  477 => 87,  469 => 82,  463 => 78,  460 => 77,  457 => 76,  454 => 75,  447 => 71,  444 => 70,  441 => 69,  439 => 68,  434 => 65,  428 => 62,  425 => 61,  423 => 60,  420 => 59,  399 => 58,  393 => 54,  372 => 53,  349 => 52,  340 => 49,  337 => 48,  315 => 47,  298 => 46,  287 => 45,  280 => 40,  258 => 39,  256 => 38,  227 => 33,  222 => 30,  204 => 28,  203 => 27,  202 => 26,  201 => 25,  197 => 24,  193 => 22,  190 => 21,  188 => 20,  185 => 19,  163 => 18,  161 => 17,  158 => 16,  156 => 15,  129 => 12,  126 => 11,  124 => 10,  120 => 8,  116 => 6,  114 => 5,  93 => 4,  72 => 3,  51 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "users_list_block.twig", "/home/mliadov/public_html/application/modules/users/views/flatty/users_list_block.twig");
    }
}
