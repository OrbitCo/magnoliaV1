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

/* my_list_block.twig */
class __TwigTemplate_e947e7c5f5a415d3c0de1df18e283dd46180afbadf73d56412c200e15f97270b extends \Twig\Template
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
        echo "<h2 class=\"b-title-control\">
    <span class=\"b-title-control__text\">";
        // line 2
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_my_banners"        ,"banners"        ,        );
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
        echo "</span>
    <div class=\"b-title-link__action\">
        <span id=\"add_banner\">
            <a class=\"btn btn-primary btn-sm\" href=\"";
        // line 5
        echo ($context["site_url"] ?? null);
        echo "banners/edit\">
                ";
        // line 6
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_add_banner"        ,"banners"        ,        );
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
        echo "            </a>
        </span>
    </div>
</h2>
<div class=\"user-banners\">
";
        // line 12
        if (($context["banners"] ?? null)) {
            // line 13
            echo "    <table class=\"table table-hover\">
        <thead>
            <tr>
                <th>";
            // line 16
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_number"            ,"banners"            ,            );
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
            echo "</th>
                <th>";
            // line 17
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_name"            ,"banners"            ,            );
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
            echo "</th>
                <th>";
            // line 18
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("activity_info"            ,"banners"            ,            );
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
            echo "</th>
                <th>";
            // line 19
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_approve"            ,"banners"            ,            );
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
            echo "</th>
                <th></th>
            </tr>
        </thead>
    ";
            // line 23
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["banners"] ?? null));
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
            foreach ($context['_seq'] as $context["_key"] => $context["banner"]) {
                // line 24
                echo "        <tr>
            <td data-label=\"";
                // line 25
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("field_number"                ,"banners"                ,                );
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
                echo $this->getAttribute($context["loop"], "index", []);
                echo ".</td>
            <td data-label=\"";
                // line 26
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("field_name"                ,"banners"                ,                );
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
                <a href=\"javascript:void(0)\" class='view_banner' id=\"view_";
                // line 27
                echo $this->getAttribute($context["banner"], "id", []);
                echo "\" title=\"";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("link_view_banner"                ,"banners"                ,""                ,"button"                ,                );
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
                echo $this->getAttribute($context["banner"], "name", []);
                echo "
                    ";
                // line 29
                if ($this->getAttribute($context["banner"], "banner_place_obj", [])) {
                    // line 30
                    echo "                        (";
                    echo $this->getAttribute($this->getAttribute($context["banner"], "banner_place_obj", []), "name", []);
                    echo " ";
                    echo $this->getAttribute($this->getAttribute($context["banner"], "banner_place_obj", []), "width", []);
                    echo "X";
                    echo $this->getAttribute($this->getAttribute($context["banner"], "banner_place_obj", []), "height", []);
                    echo ")
                    ";
                }
                // line 32
                echo "                </a>
            </td>
            <td data-label=\"";
                // line 34
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("activity_info"                ,"banners"                ,                );
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
                <div id=\"view_";
                // line 35
                echo $this->getAttribute($context["banner"], "id", []);
                echo "_content\" class=\"hide\">
                    ";
                // line 36
                if (($this->getAttribute($context["banner"], "banner_type", []) == 1)) {
                    // line 37
                    echo "                        <img src=\"";
                    echo $this->getAttribute($this->getAttribute($this->getAttribute($context["banner"], "media", []), "banner_image", []), "file_url", []);
                    echo "\"  alt=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["banner"], "alt_text", []));
                    echo "\" ";
                    echo " class=\"banner\" />
                    ";
                } else {
                    // line 39
                    echo "                        ";
                    echo $this->getAttribute($context["banner"], "html", []);
                    echo "
                    ";
                }
                // line 41
                echo "                </div>
                ";
                // line 42
                $context["limit"] = "";
                // line 43
                echo "
                ";
                // line 44
                if ($this->getAttribute($context["banner"], "stat_views", [])) {
                    // line 45
                    echo "                    ";
                    $context["limit"] = 1;
                    // line 46
                    echo "                    ";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("shows"                    ,"banners"                    ,                    );
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
                    echo " - ";
                    echo $this->getAttribute($context["banner"], "stat_views", []);
                    echo "<br/>
                ";
                }
                // line 48
                echo "
                ";
                // line 49
                if ($this->getAttribute($context["banner"], "stat_clicks", [])) {
                    // line 50
                    echo "                    ";
                    $context["limit"] = 1;
                    // line 51
                    echo "                    ";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("clicks"                    ,"banners"                    ,                    );
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
                    echo " - ";
                    echo $this->getAttribute($context["banner"], "stat_clicks", []);
                    echo "<br/>
                ";
                }
                // line 53
                echo "
                ";
                // line 54
                if (($this->getAttribute($context["banner"], "expiration_date", []) && ($this->getAttribute($context["banner"], "expiration_date", []) != "0000-00-00 00:00:00"))) {
                    // line 55
                    echo "                    ";
                    $context["limit"] = 1;
                    // line 56
                    echo "                    ";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("till"                    ,"banners"                    ,                    );
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
                    echo " - ";
                    $module =                     null;
                    $helper =                     'date_format';
                    $name =                     'tpl_date_format';
                    $params = array($this->getAttribute(($context["banner"] ?? null), "expiration_date", [])                    ,$this->getAttribute(($context["date_format_st"] ?? null), "date_literal", [])                    ,                    );
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
                    echo "                ";
                }
                // line 58
                echo "
                ";
                // line 59
                if ( !($context["limit"] ?? null)) {
                    // line 60
                    echo "                    ";
                    if ($this->getAttribute($context["banner"], "status", [])) {
                        // line 61
                        echo "                        ";
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("never_stop"                        ,"banners"                        ,                        );
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
                        // line 62
                        echo "                    ";
                    } else {
                        // line 63
                        echo "                        &nbsp;
                    ";
                    }
                    // line 65
                    echo "                ";
                }
                // line 66
                echo "            </td>
            <td data-label=\"";
                // line 67
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("field_approve"                ,"banners"                ,                );
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
                if (($this->getAttribute($context["banner"], "approve", []) == "1")) {
                    // line 69
                    echo "                    <span class=\"status\">
                        <i class=\"fa fa-chevron-circle-down fa-lg color-link_color\"></i>
                        ";
                    // line 71
                    if ($this->getAttribute($context["banner"], "status", [])) {
                        // line 72
                        echo "                            ";
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("text_banner_activated"                        ,"banners"                        ,                        );
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
                        // line 73
                        echo "                        ";
                    } else {
                        // line 74
                        echo "                            ";
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("approved"                        ,"banners"                        ,                        );
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
                        echo "                        ";
                    }
                    // line 76
                    echo "                    </span>
                ";
                } elseif (($this->getAttribute(                // line 77
$context["banner"], "approve", []) == "-1")) {
                    // line 78
                    echo "                    <span class=\"status\">
                        <i class=\"fa fa-ban fa-lg color-link_color\"></i>
                        ";
                    // line 80
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("declined"                    ,"banners"                    ,                    );
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
                    echo "                    </span>
                ";
                } else {
                    // line 83
                    echo "                    <span class=\"status wait\">
                        <i class=\"far fa-clock g fa-lg\"></i>
                        ";
                    // line 85
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("not_approved"                    ,"banners"                    ,                    );
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
                    // line 86
                    echo "                    </span>
                ";
                }
                // line 88
                echo "            </td>
            <td class=\"righted\">
                ";
                // line 90
                if (($this->getAttribute($context["banner"], "approve", []) == "1")) {
                    // line 91
                    echo "                    ";
                    if ( !$this->getAttribute($context["banner"], "status", [])) {
                        // line 92
                        echo "                        <a href=\"";
                        echo ($context["site_url"] ?? null);
                        echo "banners/activate/";
                        echo $this->getAttribute($context["banner"], "id", []);
                        echo "\" class=\"fa fa-play fa-lg\" title=\"";
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("link_activate_banner"                        ,"banners"                        ,                        );
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
                        echo "\"></a>
                    ";
                    }
                    // line 94
                    echo "                    ";
                    if (($this->getAttribute($context["banner"], "status", []) == "1")) {
                        // line 95
                        echo "                        <a href=\"";
                        echo ($context["site_url"] ?? null);
                        echo "banners/statistic/";
                        echo $this->getAttribute($context["banner"], "id", []);
                        echo "\" class=\"far fa-chart-bar fa-lg\" title=\"";
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("link_banner_stat"                        ,"banners"                        ,""                        ,"button"                        ,                        );
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
                        echo "\"></a>
                    ";
                    }
                    // line 97
                    echo "                ";
                }
                // line 98
                echo "                <a href=\"javascript:void(0);\" class=\"fas fa-trash-alt fa-lg\" onclick=\"javascript:";
                ob_start(function () { return ''; });
                // line 99
                echo "                    if (!confirm('";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("note_delete_banner"                ,"banners"                ,""                ,"js"                ,                );
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
                echo "'))
                        return false;
                    locationHref('";
                // line 101
                echo ($context["site_url"] ?? null);
                echo "banners/delete/";
                echo $this->getAttribute($context["banner"], "id", []);
                echo "');";
                echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
                echo "\"></a>
            </td>
        </tr>
    ";
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['banner'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 105
            echo "</table>
<div id=\"pages_block_2\">
            ";
            // line 107
            $context["page_data"] = twig_array_merge(($context["page_data"] ?? null), ["type" => "full"]);
            // line 108
            echo "            ";
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
            // line 109
            echo "        </div>
";
        } else {
            // line 111
            echo "    ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("no_banners"            ,"banners"            ,            );
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
        }
        // line 113
        echo "</div>
<script>
    \$(function () {
      \$(\"a.view_banner\").each(function () {
        let id = \$(this).attr('id') + '_content';
        let obj = \$('#'+id).html()
        \$(this).popover({
          html: true,
          trigger: 'hover',
          content: function () {
            return obj;
          }
        });
      });
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "my_list_block.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  843 => 113,  820 => 111,  816 => 109,  794 => 108,  792 => 107,  788 => 105,  766 => 101,  741 => 99,  738 => 98,  735 => 97,  706 => 95,  703 => 94,  674 => 92,  671 => 91,  669 => 90,  665 => 88,  661 => 86,  640 => 85,  636 => 83,  632 => 81,  611 => 80,  607 => 78,  605 => 77,  602 => 76,  599 => 75,  577 => 74,  574 => 73,  552 => 72,  550 => 71,  546 => 69,  544 => 68,  521 => 67,  518 => 66,  515 => 65,  511 => 63,  508 => 62,  486 => 61,  483 => 60,  481 => 59,  478 => 58,  475 => 57,  432 => 56,  429 => 55,  427 => 54,  424 => 53,  397 => 51,  394 => 50,  392 => 49,  389 => 48,  362 => 46,  359 => 45,  357 => 44,  354 => 43,  352 => 42,  349 => 41,  343 => 39,  334 => 37,  332 => 36,  328 => 35,  305 => 34,  301 => 32,  291 => 30,  289 => 29,  285 => 28,  260 => 27,  237 => 26,  212 => 25,  209 => 24,  192 => 23,  166 => 19,  143 => 18,  120 => 17,  97 => 16,  92 => 13,  90 => 12,  83 => 7,  62 => 6,  58 => 5,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "my_list_block.twig", "/home/mliadov/public_html/application/modules/banners/views/flatty/my_list_block.twig");
    }
}
